<x-app-layout>
    @include('layouts.header')

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="{{ route('packages.create') }}">Criar Pacote</a>
                <div>
                    <h2>Pacotes:</h2>
                    <ul>
                        <div class="flex">
                            @foreach($packages as $value)
                                <li><a href="{{ route('packages.show', [$value['id']])}}" class="block bg-indigo-500 p-2 rounded-md text-white hover:bg-indigo-300">{{ $value['name_package'] }}</a></li>
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
                    <div class="overflow-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                                
                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome do Pacote</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Descrição das comidas</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Descrição das bebidas</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Preço do pacote</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Slug</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if(count($packages) === 0)
                            <tr>
                                <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum pacote encontrado</td>
                            </tr>
                            @else
                                @php
                                    $limite_char = 30; // O número de caracteres que você deseja exibir
                                @endphp
                                @foreach($packages as $value)
                                <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['id'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                    <a href="{{ route('packages.show', [$value['id']]) }}" class="font-bold text-blue-500 hover:underline">{{ $value['name_package'] }}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ mb_strimwidth($value['food_description'], 0, $limite_char, " ...") }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ mb_strimwidth($value['beverages_description'], 0, $limite_char, " ...") }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">R$ {{ (float)$value['price'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['slug'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['status'] }}</td>
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