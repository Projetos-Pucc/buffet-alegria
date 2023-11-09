<header class="bg-amber-100 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(request()->routeIs('bookings.create'))
            @php
                $name = 'Agendar Anversário';
            @endphp   

        @elseif(request()->routeIs('bookings.show'))
            @php
                $name = 'Aniversariante {{$booking->name_birthdayperson}}';
            @endphp 

        @elseif(request()->routeIs('bookings.update'))
            @php
                $name = 'Edição da Reserva: Aniversariante {{$booking->name_birthdayperson}}';
            @endphp   

        @elseif(request()->routeIs('packages.create'))
            @php
                $name = 'Criar Pacote';
            @endphp       
        
        @elseif(request()->routeIs('packages.show'))
            @php
                $name = '$package->name_package';
            @endphp 

        @elseif(request()->routeIs('packages.update'))
            @php
                $name = 'Edição do Pacote: {{$package->name_package}}';
            @endphp   

        @elseif(request()->routeIs('recommendations.create'))
            @php
                $name = 'Criar Recomendação';
            @endphp  

        @elseif(request()->routeIs('recommendations.show'))
        @php
            $name = 'Recomendação: {{$recommendation->id}}';
        @endphp 

        @elseif(request()->routeIs('recommendations.update'))
        @php
            $name = 'Recomendação: {{$recommendation->id}}';
        @endphp   

        @elseif(request()->routeIs('schedules.create'))
            @php
                $name = 'Criar Recomendação';
            @endphp  


        @endif

        <div class="flex justify-between items-center w-100">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $name }}
            </h2>
        </div>
    </div>
</header>