<x-app-layout>
    <style>
        .input-radio input[type=radio] {
            display: none;
        }

        .input-radio input[type=radio]:checked~label {
            background-color: #facc15;
        }

        .swiper-button-prev{
            color: black;
            margin: -12px;
        }

        .swiper-button-next{
            color: black;
            margin: -13px;
        }
    </style>

    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="w-full max-w-lg"  action="{{ route('bookings.update', $booking->id) }}" method="POST" id="form">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_birthdayperson">
                                    Nome do aniversariante
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name_birthdayperson" type="text" placeholder="Guilherme" name="name_birthdayperson" value="{{old('name_birthdayperson') ?? $booking->name_birthdayperson}}">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="years_birthdayperson">
                                    Idade do aniversariante
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="years_birthdayperson" type="number" placeholder="19" name="years_birthdayperson" value="{{old('years_birthdayperson') ?? $booking->years_birthdayperson}}" min="1" step="1">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="qnt_invited">
                                    Quantidade de Convidados
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="qnt_invited" type="number" placeholder="0" name="qnt_invited" value="{{old('qnt_invited') ?? $booking->qnt_invited}}"  min="1" step="1">
                            </div>
                        </div>
                        @role('commercial|administrative')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">                            
                                <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Status da Reserva</label>
                                <select name="status" id="status" required>
                                    @foreach( App\Enums\BookingStatus::array() as $key => $value )
                                        <option value="{{$value}}" {{ $booking->status == $value ? 'selected' : ""}}>{{$key}}</option>
                                    @endforeach
                                </select>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
                            </div>
                        </div>
                        @endrole

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Pacote de comidas
                                </p>

                                <!-- Slider main container -->
                                <div class="swiper">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        @if(count($packages) === 0)
                                        <h1>Nenhum pacote de comida encontrado!</h1>
                                        @else
                                        @foreach($packages as $key => $package)

                                        <div class="swiper-slide input-radio p-4 max-w-xl rounded overflow-hidden shadow-lg">
                                            <input 
                                            {{ $key === 0 ? "required" : "" }}
                                            {{ $booking->package_id == $package['id'] ? "checked" : ""}}
                                             type="radio" name="package_id"
                                              id="package-{{$package['id']}}"
                                               value="{{$package['id']}}"
                                                class="px-8 py-8" >
                                            <label for="package-{{$package['id']}}" class="px-6 py-4 bg-amber-100 block">
                                                <span class="font-bold block text-lg">
                                                    {{$package['name_package']}}
                                                </span>
                                                <span class="block">
                                                    R$: <span class="font-bold text-xl">{{number_format((float) $package['price'], 2)}}</span> p/ pessoa
                                                </span>
                                                <button id='button-package-{{$package['id']}}'class="see-details-button bg-amber-400 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded
                                                    inline-flex items-center px-3 py-2 border border-transparent text-sm leading-">Ver detalhes</button>
                                            </label>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>

                                    <!-- If we need navigation buttons -->
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>

                                </div>

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
                        <br> 
                        <button type="submit" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Salvar
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="module">
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            slidesPerView: 3,
            spaceBetween: 10,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        const see_details = document.querySelectorAll(".see-details-button")
        see_details.forEach((button)=>{
            button.addEventListener('click', async (e)=>{
                e.preventDefault()

                const btn_id = button.id.split('button-package-')[1]
                
                const pk = await getPackage(btn_id)
                const data = {
                    title: pk.name_package,
                    content: `
                        <p><b>Por apenas R$ ${pk.price}</b></p>
                        <br>
                        <p><b>Descrição do pacote:</b></p>
                        <br>
                        <p><b>Comidas:</b></p>
                        ${pk.food_description}
                        <br><br>
                        <p><b>Bebidas:</b></p>
                        ${pk.beverages_description}

                        <img class="w-full" src="{{asset('storage/packages/${pk.photo_1}')}}">
                        <img class="w-full" src="{{asset('storage/packages/${pk.photo_2}')}}">
                        <img class="w-full" src="{{asset('storage/packages/${pk.photo_3}')}}">
                    `
                }
                html(data)
            })
        })
        const party_day = document.querySelector("#party_day")
        const party_time = document.querySelector("#open_schedule_id")
        const packages = document.querySelectorAll("input[name=package_id]")
        const price = document.querySelector("#preco")
        const qtd_invited = document.querySelector("#qnt_invited")
        const form = document.querySelector("#form")

        form.addEventListener('submit', async function (e) {
            e.preventDefault()
            const userConfirmed = await confirm(`Deseja agendar um aniversario no dia ${party_day.value} as ${party_time.options[party_time.selectedIndex].text}?`)

            if (userConfirmed) {
                this.submit();
            } else {
                error("Ocorreu um erro!")
            }
        })

        const SITEURL = "{{ url('/') }}";

        let package_selected = {}
        const original_schedule = "{{ $booking->open_schedule_id }}"

        async function execute() {
            const pk = document.querySelector('input[name=package_id]:checked')
            if (pk) {
                const invited = qtd_invited.value ?? 0
                const package_local = await getPackage(pk.value)
                package_selected = package_local;

                price.innerHTML = invited * package_local.price
            } else {
                price.innerHTML = 0
            }

            if (party_day.value) {
                const dates = await getDates(party_day.value)

                printDates(dates)
            }
        }
        
        execute()
        async function getPackage(package_id) {
            const csrf = document.querySelector('meta[name="csrf-token"]').content
            const data = await axios.get(SITEURL + '/api/packages/' + package_id, {
                headers: {
                    'X-CSRF-TOKEN': csrf
                }
            })

            return data.data;
        }

        packages.forEach((pk) => {
            pk.addEventListener('change', async (e) => {
                const invited = qtd_invited.value ?? 0
                const package_local = await getPackage(e.target.value)
                package_selected = package_local;

                price.innerHTML = invited * package_local.price
            })
        })

        qtd_invited.addEventListener('change', async (e) => {
            if (Object.keys(package_selected).length !== 0) {
                price.innerHTML = e.target.value * package_selected.price
            } else {
                price.innerHTML = 0
            }
        })

        async function getDates(day) {
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
            while (party_time.options.length > 1) {
                party_time.remove(1); // Remova a segunda opção em diante (índice 1)
            }
            agora.setDate(agora.getDate() + 5);
            if (escolhida < agora) {
                this.value = agora.toISOString().split('T')[0];
                error("Você não pode colocar datas retroativas nem menores que 5 dias contados a partir de hoje.")
            }

            const dates = await getDates(this.value)

            printDates(dates)
        });

        function printDates(dates) {
            const options = dates.map((date) => {
                const party_date = new Date("1970-01-01T" + date.time + "Z");
                party_date.setHours(party_date.getHours() + date.hours);
                var horaFinal = party_date.toISOString().substr(11, 8);
                return {
                    msg: `${date.time} - ${horaFinal}`,
                    value: date.id
                }
            })

            for (let i = 0; i < options.length; i++) {
                const option = document.createElement("option");
                option.text = options[i].msg;
                option.value = options[i].value
                party_time.appendChild(option);
                if(options[i].value == Number(original_schedule)) {
                    option.selected = true
                }
            }
        }
    </script>
</x-app-layout>