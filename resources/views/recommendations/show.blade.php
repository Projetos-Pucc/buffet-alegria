
<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <p><strong>Recomendação: </strong> {{ $recommendation->id }}</p><br>
                <p><strong>Conteúdo: </strong> {!! $recommendation->content !!}</p><br>
                <div class="flex items-center ml-auto float-down">
                    <a href="{{ route('recommendations.edit', [$recommendation->id]) }}" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded">
                        <div class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4">
                            Editar
                        </div>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>