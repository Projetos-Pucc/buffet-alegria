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

                    <form class="w-full max-w-lg" action="{{ route('guests.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_package">
                                    Nome do convidado
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nome" type="text" placeholder="Fulano" name="nome" value="{{old('nome')}}">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="slug">
                                    CPF
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="cpf" type="text" placeholder="CPF do fulano" name="cpf" value="{{old('cpf')}}">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="qnt_invited">
                                    Idade 
                                </label>
                            <input  type="number" id="idade" name="idade" placeholder="Idade do Fulano">{{old('idade')}}</textarea>
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
        
    </script>
</x-app-layout>