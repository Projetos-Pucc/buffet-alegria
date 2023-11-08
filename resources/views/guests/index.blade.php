<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Convidados') }}
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="{{ route('guests.create') }}">Criar Pacote</a>
                <div>
                    <h2>Pacotes:</h2>
                    <ul>
                        <div class="flex">
                            @foreach($guests as $value)
                                <li><a href="{{ route('packages.show', [$value['id']])}}" class="block bg-indigo-500 p-2 rounded-md text-white hover:bg-indigo-300">{{ $value['nome'] }}</a></li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-right mb-5">
                        <a href="{{ route('guests.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar Convidados</a>
                    </div>
                    
                    <div class="overflow-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                                
                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">CPF</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Idade</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Booking</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if(count($guests) === 0)
                            <tr>
                                <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum convidado encontrado</td>
                            </tr>
                            @else
                                @php
                                    $limite_char = 30; // O número de caracteres que você deseja exibir
                                @endphp
                                @foreach($packages as $value)
                                <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['id'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                    <a href="{{ route('guests.show', [$value['id']]) }}" class="font-bold text-blue-500 hover:underline">{{ $value['nome'] }}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ mb_strimwidth($value['cpf'], 0, $limite_char, " ...") }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ (int)$value['idade'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['status'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{route('bookings.show', [$guest['booking_id']])}}" class="font-bold text-blue-500 hover:underline">{{ $guest['name_birthdayperson']}}></a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">X</td>
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