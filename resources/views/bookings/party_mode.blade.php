<x-app-layout>
    @include('layouts.header_general'); 

    <div>
        @if($guest_counter === 0)
            <h1><strong>ESSA FESTA NÃO TEM CONVIDADOS CONFIRMADOS!</strong></h1>
        
        @else
            <br>
            <h1>
                <strong>Quantidade de convidados chegaram:</strong><p>{{$guest_counter['arrived']}} de {{$guest_counter['unblocked']}}</p>
            </h1> 
            </div> 
            <h1><strong>Lista de Convidados:</strong></h1>
            <br>
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                        
                        <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center">CPF</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center">Idade</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @if(count($guests) === 0)
                    <tr>
                        <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-left">Nenhum convidado encontrado</td>
                    </tr>
                    @else
                        @php
                            $limite_char = 30; // O número de caracteres que você deseja exibir
                        @endphp
                        @foreach($guests as $key=>$value)
                        <tr class="bg-white">
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $key+1 }}</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-left">{{ $value['nome'] }}</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ mb_strimwidth($value['cpf'], 0, $limite_char, " ...") }}</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ (int)$value['idade'] }}</td>
                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full  px-3 mb-6 md:mb-0">

                                    <form action="{{route('guests.updateStatus',$value['id'])}}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"></label>
                                        <select name="status" id="status" required onchange="this.form.submit()">
                                            @foreach( App\Enums\GuestStatus::array() as $key => $status )
                                                <option value="{{$status}}" {{ $value->status == $status ? 'selected' : ""}}>{{$key}}</option>
                                            @endforeach
                                            <!-- <option value="invalid2"  disabled>Nenhum horario disponivel neste dia, tente novamente!</option> -->
                                        </select>
                                    </form>
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
    
                                    <!-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> -->
                                </div>
                        </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            {{ $guests->links('components.pagination') }}
        @endif
        <div>CONVIDADOS EXTRA</div>
        <button type="button" id="clone-button">+</button>

    <form class="w-full max-w-lg" action="{{ route('guests.store') }}" method="POST" enctype="multipart/form-data" id="form">
        <div id="form-rows">
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        <div id="form-rows">
                            <div class="form-row">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nome0">
                                            Nome do convidado
                                        </label>
                                        <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nome0" type="text" placeholder="Fulano" name="rows[0][nome]" value="{{old('nome')}}">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cpf0">
                                            CPF
                                        </label>
                                        <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white cpfs" id="cpf0" type="text" placeholder="CPF do fulano" name="rows[0][cpf]" value="{{old('cpf')}}">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full  px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="idade0">
                                            Idade 
                                        </label>
                                    <input required type="number" id="idade0" name="rows[0][idade]" placeholder="Idade do Fulano">{{old('idade')}}
                                    </div>
                                </div>
                            </div>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
            Adicionar convidado
        </button>
    </form>

    <script>
        document.getElementById('clone-button').addEventListener('click', function() {
            // Quando o botão "+" é clicado, alterne a visibilidade do bloco de código
            var formRows = document.getElementById('form-rows');
            formRows.style.display = (formRows.style.display === 'none' || formRows.style.display === '') ? 'block' : 'none';
        });
    </script>

    </div>

    <script>
        clone_button.addEventListener('click', (e)=>{
            e.preventDefault()
            clonarCampos()
        })
        let contadorCampos = 1;
        function clonarCampos() {
            const camposOriginais = document.querySelector('.form-row');
            const novoCampos = camposOriginais.cloneNode(true);

            novoCampos.querySelectorAll('input').forEach((input) => {
                input.id = input.id.replace(/\d+/, contadorCampos);
                input.name = input.name.replace(/\d+/, contadorCampos);
                input.value = '';
            });

            // novoCampos.querySelectorAll('.cpfs').forEach((input) => {
            //     input.addEventListener('input', function (e) {
            //         formatCPFInput(e.target.value, e.data, e.target.id)
            //     });
            // });

            novoCampos.querySelectorAll('label').forEach((label) => {
                const novoFor = label.getAttribute('for').replace(/\d+/, contadorCampos);
                label.setAttribute('for', novoFor);
            });


            document.getElementById('form-rows').appendChild(novoCampos);
            contadorCampos++;
        }
    </script>

</x-app-layout>