<x-guest-layout>
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
                                        <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white cpfs" id="cpf0" type="text" placeholder="CPF do fulano" name="rows[0][cpf]" value="{{old('cpf[0]')}}" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF válido (XXX.XXX.XXX-XX)">
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

                        <button type="button" id="clone-button" style="width: 50px; height: 50px;" class="bg-amber-300 rounded-md text-xl">+</button>
                        
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Adicionar convidado
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cpfs = document.querySelectorAll(".cpfs");
        const cpf = document.querySelector('#cpf0')
        const form = document.querySelector("#form")
        const clone_button = document.querySelector("#clone-button")
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

            novoCampos.querySelectorAll('label').forEach((label) => {
                const novoFor = label.getAttribute('for').replace(/\d+/, contadorCampos);
                label.setAttribute('for', novoFor);
            });


            document.getElementById('form-rows').appendChild(novoCampos);
            contadorCampos++;
        }
        
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, '');

            if (cpf.length !== 11) {
                return false;
            }

            if (/^(\d)\1+$/.test(cpf)) {
                return false;
            }

            let soma = 0;
            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let digito1 = 11 - (soma % 11);
            digito1 = (digito1 >= 10) ? 0 : digito1;

            if (parseInt(cpf.charAt(9)) !== digito1) {
                return false;
            }

            soma = 0;
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            let digito2 = 11 - (soma % 11);
            digito2 = (digito2 >= 10) ? 0 : digito2;

            if (parseInt(cpf.charAt(10)) !== digito2) {
                return false;
            }

            return true;
        }

        form.addEventListener('submit', function (e){
            e.preventDefault()
            const cpfs = document.querySelectorAll('.cpfs')

            let erro = false
            cpfs.forEach(cpf => {
                const cpf_valid = validarCPF(cpf.value)
                if(!cpf_valid) {
                    error("O cpf é invalido")
                    erro = true
                    return;
                }
            });
            if(erro) return
            this.submit();
        })

    </script>
</x-guest-layout>