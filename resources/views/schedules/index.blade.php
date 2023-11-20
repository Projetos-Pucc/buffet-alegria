<x-app-layout>
    @include('layouts.header_index')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->

                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Horario [hh:mm:ss]</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Duração [hrs]</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if(count($schedules) === 0)
                            <tr>
                                <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum horario encontrado!</td>
                            </tr>
                            @else
                                @php
                                    $class_active = "p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50";
                                    $class_unactive = 'p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50';
                                @endphp
                                @foreach($schedules as $value)
                                <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['id'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                       {{ $value['time'] }}
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        {{ $value['hours']}}
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <span class="{{ $value['status'] == 1 ? $class_active : $class_unactive }}">{{ $value['status'] == 1 ? "Ativado" : "Desativado" }}</span>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('schedules.edit', $value['id']) }}" title="Editar '{{$value['time']}}'">✏️</a>
                                        <form action="{{ route('schedules.change_status', $value['id']) }}" method="post" class="inline">
                                            @csrf
                                            @method('patch')
                                            @if($value['status'] == true)
                                                <button type="submit" title="Deletar '{{$value['time']}}'">❌</button>
                                            @else
                                                <button type="submit" title="Ativar '{{$value['time']}}'">✅</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    {{ $schedules->links('components.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>