<header class="bg-amber-100 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(request()->routeIs('bookings.create'))
            @php
                $name = 'Agendar Aniversário';
            @endphp   

        @elseif(request()->routeIs('bookings.show'))
            @php
                $name = 'Aniversariante';
            @endphp 

        @elseif(request()->routeIs('bookings.update'))
            @php
                $name = 'Edição da Reserva';
            @endphp   

        @elseif(request()->routeIs('bookings.list'))
            @php
                $name = 'Listagem de Reservas';
            @endphp   

        @elseif(request()->routeIs('bookings.edit'))
            @php
                $name = 'Edição da Reserva';
            @endphp  

        @elseif(request()->routeIs('packages.create'))
            @php
                $name = 'Criar Pacote';
            @endphp       
        
        @elseif(request()->routeIs('packages.show'))
            @php
                $name = 'Pacotes';
            @endphp 

        @elseif(request()->routeIs('packages.update'))
            @php
                $name = 'Edição do Pacote';
            @endphp   

        @elseif(request()->routeIs('package.edit'))
            @php
                $name = 'Edição da Pacote';
            @endphp  

        @elseif(request()->routeIs('recommendations.create'))
            @php
                $name = 'Criar Recomendação';
            @endphp  

        @elseif(request()->routeIs('recommendations.show'))
            @php
                $name = 'Recomendação';
            @endphp 

        @elseif(request()->routeIs('recommendations.update'))
            @php
                $name = 'Recomendação';
            @endphp   

        @elseif(request()->routeIs('recommendations.edit'))
            @php
                $name = 'Recomendação';
            @endphp   

        @elseif(request()->routeIs('schedules.create'))
            @php
                $name = 'Criar Horário';
            @endphp  

        @elseif(request()->routeIs('schedules.show'))
            @php
                $name = 'Horário';
            @endphp 

        @elseif(request()->routeIs('schedules.update'))
            @php
                $name = 'Horários';
            @endphp   

        @elseif(request()->routeIs('schedules.edit'))
            @php
                $name = 'Horários';
            @endphp   
        @elseif(request()->routeIs('guests.index'))
            @php
                $name = 'Convidados';
            @endphp   
        @elseif(request()->routeIs('guests.show'))
            @php
                $name = 'Convidados';
            @endphp   
        @elseif(request()->routeIs('survey.create_question'))
            @php
                $name = 'Pesquisa de Satisfação';
            @endphp   
        @elseif(request()->routeIs('survey.show_question'))
            @php
                $name = 'Pesquisa de Satisfação';
            @endphp   
        @elseif(request()->routeIs('survey.edit_question'))
            @php
                $name = 'Pesquisa de Satisfação';
            @endphp   
        @endif

        <div class="flex justify-between items-center w-100">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $name }}
            </h2>
        </div>
    </div>
</header>