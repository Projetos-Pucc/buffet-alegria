<x-app-layout >
    @include('layouts.header_index')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                        <h1>Minhas reservas</h1>
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome Aniversariante</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Convidados</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Pacote</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Data Inicio</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Data Fim</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if(count($bookings) === 0)
                            <tr>
                                <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhuma reserva encontrada</td>
                            </tr>
                            @else
                                @foreach($bookings as $booking)
                                <tr class="bg-gray-100">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('bookings.show', [$booking['id']]) }}" class="font-bold text-blue-500 hover:underline">{{ $booking['id'] }}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                        <a href="{{ route('bookings.show', [$booking['id']]) }}" class="font-bold text-blue-500 hover:underline">{{ $booking['name_birthdayperson'] }}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $booking['qnt_invited'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('packages.show', [$booking['package_id']]) }}" class="font-bold text-blue-500 hover:underline">{{ $booking['package']['name_package'] }}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ date('d/m/Y',strtotime($booking['party_day'])) }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ date("H:i", strtotime($booking['open_schedule']['time'])) }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ date("H:i", strtotime($booking['open_schedule']['time']) + $booking['open_schedule']['hours'] * 3600) }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        @php
                                        $class = '';
                                        if ($booking['status'] === 'A') {
                                        $class = "p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50";
                                        } elseif ($booking['status'] === 'P') {
                                        $class = "p-1.5 text-xs font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50";
                                        } elseif ($booking['status'] === 'N') {
                                        $class = 'p-1.5 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50';
                                        } elseif ($booking['status'] === 'F' || $booking['status'] === 'E') {
                                        $class = 'p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-400 rounded-lg bg-opacity-50';
                                        } else {
                                        $class = 'Valor padrão';
                                        }
                                        @endphp
                                        <span class="{{ $class }}">{{ App\Enums\BookingStatus::fromValue($booking['status']) }}</span>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{ route('bookings.show', $booking['id']) }}" title="Visualizar '{{$booking['name_birthdayperson']}}'">👁️</a>
                                        <a href="{{ route('bookings.edit', $booking['id']) }}" title="Editar '{{$booking['name_birthdayperson']}}'">✏️</a>
                                        <form action="{{ route('bookings.delete', $booking['id']) }}" method="post" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" title="Deletar '{{$booking['name_birthdayperson']}}'">❌</button>
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
