<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Convidado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                    @endif

                    <h1>Bem vindo a festa</h1>

                    <form class="w-full max-w-lg" action="{{ route('guests.store') }}" method="POST" enctype="multipart/form-data" id="form">

                        @csrf

                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nome">
                                    Nome do convidado
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nome" type="text" placeholder="Fulano" name="nome" value="{{old('nome')}}">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cpf">
                                    CPF
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="cpf" type="text" placeholder="CPF do fulano" name="cpf" value="{{old('cpf')}}">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="idade">
                                    Idade 
                                </label>
                            <input  type="number" id="idade" name="idade" placeholder="Idade do Fulano">{{old('idade')}}
                            </div>
                        </div>
                        
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Adicionar convidado
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cpf = document.querySelector("#cpf");
        const form = document.querySelector("#form")
    
        cpf.addEventListener('input', (e) => {
            const possible_values = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            let inputLength = cpf.value.length;
    
            if(inputLength <= 14) {
                if (possible_values.includes(e.data)) {
                    if (inputLength === 3 || inputLength === 7) {
                        cpf.value += '.';
                    } else if (inputLength === 11) {
                        cpf.value += '-';
                    }
                } else {
                    cpf.value = cpf.value.slice(0, -1);
                }
            } else {
                cpf.value = cpf.value.slice(0, -1);
            }
        });

        function validarCPF(cpf) {
            // Remover caracteres não numéricos
            cpf = cpf.replace(/[^\d]/g, '');

            // Verificar se tem 11 dígitos
            if (cpf.length !== 11) {
                return false;
            }

            // Verificar se todos os dígitos são iguais
            if (/^(\d)\1+$/.test(cpf)) {
                return false;
            }

            // Calcular o primeiro dígito verificador
            let soma = 0;
            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let digito1 = 11 - (soma % 11);
            digito1 = (digito1 >= 10) ? 0 : digito1;

            // Verificar o primeiro dígito verificador
            if (parseInt(cpf.charAt(9)) !== digito1) {
                return false;
            }

            // Calcular o segundo dígito verificador
            soma = 0;
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            let digito2 = 11 - (soma % 11);
            digito2 = (digito2 >= 10) ? 0 : digito2;

            // Verificar o segundo dígito verificador
            if (parseInt(cpf.charAt(10)) !== digito2) {
                return false;
            }

            // CPF válido
            return true;
        }

        form.addEventListener('submit', function (e){
            e.preventDefault()

            const cpf_valid = validarCPF(cpf.value)
            if(!cpf_valid) {
                alert("O cpf é invalido")
                return;
            }

            this.submit();
        })

    </script>
</x-app-layout>