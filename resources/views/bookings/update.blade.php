<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Reserva: {{$booking->id}} </h1>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    @endif
                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_birthdayperson">
                                    Nome do aniversariante
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name_birthdayperson" type="text" placeholder="Guilherme" name="name_birthdayperson" value="{{old('name_birthdayperson') ?? $booking->name_birthdayperson}}">
			                    <!-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> -->
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="years_birthdayperson">
                                    Idade do aniversariante
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="years_birthdayperson" type="number" placeholder="19" name="years_birthdayperson" value="{{old('years_birthdayperson') ?? $booking->years_birthdayperson}}" min="1" step="1">
			                    <!-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> -->
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="qnt_invited">
                                    Quantidade de Convidados
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="qnt_invited" type="number" placeholder="0" name="qnt_invited" value="{{old('qnt_invited') ?? $booking->qnt_invited}}"  min="1" step="1">
			                    <!-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> -->
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Pacote de comidas
                                </p>
                                @if(count($packages) === 0)
                                    <h1>Nenhum pacote de comida encontrado!</h1>
                                @else
                                    @foreach($packages as $package)
                                        <div>
                                            <input required type="radio" name="package_id" id="package-{{$package['id']}}"
                                             value="{{$package['id']}}"
                                                {{ ((old('package_id') == $package['id'])
                                                or 
                                                ($booking->package_id == $package['id'])) ? 
                                                'checked' : ''}}
                                             >
                                            <label for="package-{{$package['id']}}">{{$package['name_package']}}</label>
                                        </div>
                                    @endforeach
                                @endif
			                    <x-input-error :messages="$errors->get('package')" class="mt-2" />
                            </div>
                        </div>
                        

                        <div>
                            <label for="party_day">Data de começo</label>
                            <input required type="date" id="party_day" name="party_day" value="{{old('party_day') ?? $booking->party_day}}">
                            <x-input-error :messages="$errors->get('party_day')" class="mt-2" />
                        </div>

                        <div>
                            <label for="open_schedule_id">Data do fim</label>
                            <select name="open_schedule_id" id="open_schedule_id" required>
                                <option value="invalid" selected disabled>Selecione um horario disponível</option>
                                <!-- <option value="invalid2"  disabled>Nenhum horario disponivel neste dia, tente novamente!</option> -->
                            </select>
                        </div>

                        <div>
                            <p>Preço final: R$ <span id="preco">0</span></p>
                        </div>
                        @method('put')

                        <button type="submit">Editar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const party_day = document.querySelector("#party_day")
        const party_time = document.querySelector("#open_schedule_id")
        const packages = document.querySelectorAll("input[name=package_id]")
        const price = document.querySelector("#preco")
        const qtd_invited = document.querySelector("#qnt_invited")

        const SITEURL = "{{ url('/') }}";

        let package = {}

        async function execute() {
            const pk = document.querySelector('input[name=package_id]:checked')
            if(pk) {
                const invited = qtd_invited.value ?? 0
                const package_local = await getPackage(pk.value)
                package = package_local;
    
                price.innerHTML = invited * package_local.price
            } else {
                price.innerHTML = 0
            }

            if(party_day.value) {
                const dates = await getDates(party_day.value)

                printDates(dates, '{{$booking->open_schedule_id}}')
            }
        }
        execute()

        async function getPackage(package_id) {
            const csrf = document.querySelector('meta[name="csrf-token"]').content
            const data = await axios.get(SITEURL + '/api/packages/'+package_id, {
                headers: {
                    'X-CSRF-TOKEN': csrf
                }
            })
            
            return data.data;
        }

        packages.forEach((pk)=>{
            pk.addEventListener('change', async (e) => {
                const invited = qtd_invited.value ?? 0
                const package_local = await getPackage(e.target.value)
                package = package_local;

                price.innerHTML = invited * package_local.price
            })
        })

        qtd_invited.addEventListener('change', async(e)=>{
            if(Object.keys(package).length !== 0) {
                price.innerHTML = e.target.value * package.price
            } else {
                price.innerHTML = 0
            }
        })

        async function getDates(day, update) {
            const csrf = document.querySelector('meta[name="csrf-token"]').content
            const data = await axios.get(SITEURL + '/schedules/open/'+day+'?update={{$booking->id}}', {
                headers: {
                    'X-CSRF-TOKEN': csrf
                }
            })
            
            return data.data;
        }


        party_day.addEventListener('change', async function() {
            const agora = new Date();
            const escolhida = new Date(this.value);
            console.log('a')
            while (party_time.options.length > 1) {
                party_time.remove(1); // Remova a segunda opção em diante (índice 1)
            }
            console.log(escolhida, agora)
            console.log(this.value)
            if (escolhida < agora) {
                this.value = [agora.getFullYear(), agora.getMonth() + 1, agora.getDate()].map(v => v < 10 ? '0' + v : v).join('-');
                //adicionar regra de negocio de min days com arquivo de configuração
                alert("Você não pode colocar datas retroativas!")
                return;
            }

            const dates = await getDates(this.value)

            printDates(dates)
        });

        function printDates(dates, id_selecionado = "") {
            const options = dates.map((date)=>{
                const party_date = new Date("1970-01-01T" + date.time + "Z");
                party_date.setHours(party_date.getHours() + date.hours);
                var horaFinal = party_date.toISOString().substr(11, 8);
                return {
                    id: date.id,
                    msg: `${date.time} - ${horaFinal}`,
                    value: date.id
                }
            })

            for (let i = 0; i < options.length; i++) {
                const option = document.createElement("option");
                option.text = options[i].msg;
                option.value = options[i].value
                if(id_selecionado != "" && options[i].id == id_selecionado) {
                    option.selected = true;
                }
                party_time.appendChild(option);
            }
        }
    </script>
</x-app-layout>