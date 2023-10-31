<header class="bg-amber-100 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(request()->routeIs('bookings.index'))
            @php
                $name = 'Reservas';
            @endphp
        @elseif(request()->routeIs('packages.index'))
            @php
                $name = 'Pacotes';
                @endphp
        @endif
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $name }}
        </h2>
    </div>
</header>
