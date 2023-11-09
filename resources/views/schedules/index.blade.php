<x-app-layout>
    @include('layouts.header_index')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-right mb-5">
                        <a href="{{ route('schedules.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Criar horário</a>
                    </div>

                    <div class="overflow-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->

                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Horario</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Duração</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if(count($schedules) === 0)
                            <tr>
                                <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum horario encontrado!</td>
                            </tr>
                            @else
                                @foreach($schedules as $value)
                                <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['id'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('schedules.show', [$value['id']]) }}" class="font-bold text-blue-500 hover:underline">{{ $value['time'] }}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        {{ $value['hours']}}
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('schedules.show', $value['id']) }}" title="Visualizar '{{$value['time']}}'">👁️</a>
                                        <a href="{{ route('schedules.edit', $value['id']) }}" title="Editar '{{$value['time']}}'">✏️</a>
                                        <form action="{{ route('schedules.delete', $value['id']) }}" method="post" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" title="Deletar '{{$value['time']}}'">❌</button>
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