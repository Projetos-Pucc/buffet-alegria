<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('bookings.create') }}">Agendar Aniversario</a>
                    <ul>
                        @foreach($bookings as $value)
                            <li>{{ $value['name_birthdayperson'] }}</li>
                            <li><a href="{{ route('bookings.show', [$value['id']])}}">Ir</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>