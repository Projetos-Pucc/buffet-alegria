<header class="bg-amber-100 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(request()->routeIs('bookings.index'))
            @php
                $name = 'Reservas';
                $create = 'Listar todas as reservas';
                $route = route('bookings.list');
                $role = "commercial|administrative";
            @endphp      
        @elseif(request()->routeIs('dashboard'))
            @php
                $name = 'Minhas reservas';
                $create = 'Agendar Aniversário';
                $route = route('bookings.create');
                $role = "*"
            @endphp
            
        @elseif(request()->routeIs('packages.index'))
            @php
            $name = 'Pacotes';
            $create = 'Criar pacotes';
            $route = route('packages.create');
            $role = "commercial|administrative";
            @endphp
        @elseif(request()->routeIs('recommendations.index'))
            @php
            $name = 'Recomendações';
            $create = 'Criar Recomendações ';
            $route = route('recommendations.create');
            $role = "commercial|administrative";
            @endphp

        @elseif(request()->routeIs('schedules.index'))
            @php
            $name = 'Horários';
            $create = 'Criar Horários ';
            $route = route('schedules.create');
            $role = "commercial|administrative";
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
                @if(@isset($route))
                    @if($role == "*")
                        <a href="{{$route}}" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded">
                            <div class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4">
                                {{$create}}
                            </div>
                        </a>
                    @endif
                    @role($role)
                        <a href="{{$route}}" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded">
                            <div class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4">
                                {{$create}}
                            </div>
                        </a>
                    @endrole
                 
                @endisset
            </div>
            </div>
            </div>
        </div>
    </div>
</header>
