<x-app-layout>
    @include('layouts.header_index')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-right mb-5">
                        <a href="{{ route('recommendations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Criar recomendação</a>
                    </div>
                    
                    <div class="overflow-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                                
                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">Conteudo</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if(count($recommendations) === 0)
                            <tr>
                                <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhuma recomendação encontrada</td>
                            </tr>
                            @else
                                @php
                                    $limite_char = 30; // O número de caracteres que você deseja exibir
                                @endphp
                                @foreach($recommendations as $value)
                                <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['id'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                    <a href="{{ route('recommendations.show', [$value['id']]) }}" class="font-bold text-blue-500 hover:underline">{{ $value['content'] }}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('recommendations.show', $value['id']) }}" title="Visualizar recomendação {{$value['id']}}">👁️</a>
                                        <a href="{{ route('recommendations.edit', $value['id']) }}" title="Editar recomendação {{$value['id']}}">✏️</a>
                                        <form action="{{ route('recommendations.delete', $value['id']) }}" method="post" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" title="Deletar recomendação {{$value['id']}}">❌</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>