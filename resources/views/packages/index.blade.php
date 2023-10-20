<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="{{ route('packages.create') }}">Criar Pacote</a>
                <div>
                    <h2>Pacotes:</h2>
                    <ul>
                        @foreach($packages as $value)
                            <li>{{ $value['name_package'] }} <a href="{{ route('packages.show', [$value['id']])}}">Ir</a></li>
                        @endforeach
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>