<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Aniversariante {{$booking->name_birthdayperson}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('bookings.edit', [$booking->id]) }}">Editar</a>

                    {{ $booking->id }}
                    {{ $booking->name_birthdayperson }}
                    {{ $booking->qnt_invited }}
                    {{ $booking->package['name_package'] }}
                    {{ $booking->party_start }}
                    {{ $booking->party_end }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>