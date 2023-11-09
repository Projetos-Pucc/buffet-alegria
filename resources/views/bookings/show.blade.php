<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('bookings.edit', [$booking->id]) }}">Editar</a>

                    {{ $booking->id }}
                    {{ $booking->name_birthdayperson }}
                    {{ $booking->qnt_invited }}
                    {{ $booking->package['name_package'] }}
                    {{ $booking->party_day }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>