<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pacote: {{$recommendation->id}}
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

                    <form class="w-full max-w-lg" action="{{ route('recommendations.update', $package->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('put')

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="qnt_invited">
                                    Descrição das bebidas
                                </label>
                                <textarea name="beverages_description" id="" cols="30" rows="5" placeholder="beverages_description">{{ old('content') ?? $recommendation->content }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Atualizar Recomendação
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>
</x-app-layout>