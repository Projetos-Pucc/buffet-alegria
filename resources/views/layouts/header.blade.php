<header class="bg-amber-100 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(request()->routeIs('bookings.index'))
            @php
                $name = 'Reservas';
                $create = 'Agendar Aniversaário';
                $route = 'bookings.create';
            @endphp
        @elseif(request()->routeIs('packages.index'))
            @php
                $name = 'Pacotes';
                $create = 'Criar pacotes';
                $route = 'packages.create';
                @endphp
        @elseif(request()->routeIs('dashboard'))
            @php
                $name = 'Dashboard';
                $create = 'Agendar Aniversário';
                $route = 'bookings.create';
                @endphp
        @elseif(request()->routeIs('packages.create'))
        @php
            $name = 'Pacote: {{$package->name_package}}';
            $create = 'Editar';
            $route = 'packages.update';
            @endphp
        @endif
        <div class="flex justify-between items-center w-100">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $name }}
            </h2>
            <div class="hidden md:block">
            <div class="ml-400 flex items-center md:ml-30">
                <!-- Profile dropdown -->
                <div class="flex items-center ml-auto">
             <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-amber-300 hover:text-black hover:bg-amber-500 focus:outline-none transition ease-in-out duration-150">
             <a href="{{ route($route) }}" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded">{{$create}}</a>
             </button>
            </div>
            </div>
            </div>
        </div>
    </div>
</header>
