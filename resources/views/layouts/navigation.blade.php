<div class="min-h-full">
    <nav class="bg-amber-200">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                  <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-amber-500 text-black' : 'text-black-300 hover:bg-amber-300 hover:text-black' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ request()->routeIs('dashboard') ? 'page' : '' }}">Dashboard</a>
                  @unlessrole('user')
                    <a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.index') ? 'bg-amber-500 text-black' : 'text-black-300 hover:bg-amber-300 hover:text-black'}} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ request()->routeIs('bookings.index') ? 'page' : '' }}">{{ __('Reservas') }}</a>
                    @role('administrative|commercial')
                      <a href="{{ route('packages.index') }}" class="{{ request()->routeIs('packages.index') ? 'bg-amber-500 text-black' : 'text-black-300 hover:bg-amber-300 hover:text-black' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ request()->routeIs('packages') ? 'page' : '' }}">{{ __('Pacotes') }}</a>
                      <a href="{{ route('recommendations.index') }}" class="{{ request()->routeIs('recommendations.index') ? 'bg-amber-500 text-black' : 'text-black-300 hover:bg-amber-300 hover:text-black' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ request()->routeIs('recommendations') ? 'page' : '' }}">{{ __('Recomendações') }}</a>
                      <a href="{{ route('schedules.index') }}" class="{{ request()->routeIs('schedules.index') ? 'bg-amber-500 text-black' : 'text-black-300 hover:bg-amber-300 hover:text-black' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ request()->routeIs('schedules') ? 'page' : '' }}">{{ __('Horários') }}</a>
                    @endrole
                  @endunlessrole
                    <!-- <a href="#" class="{{ request()->routeIs('guests.list') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ request()->routeIs('guests.list') ? 'page' : '' }}">{{ __('Lista de convidados') }}</a> -->
                   <!--   <a href="#" class="{{ request()->routeIs('satisfaction.search') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ request()->routeIs('satisfaction.search') ? 'page' : '' }}">{{ __('Pesquisa de satisfação') }}</a> -->
                  </div>                  
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
                <!-- Profile dropdown -->
              <div class="relative ml-3">
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                  <x-dropdown>
                      <x-slot name="trigger">
                          <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-amber-300 hover:text-black hover:bg-amber-500 focus:outline-none transition ease-in-out duration-150">
                              <div>{{ Auth::user()->name }}</div>
  
                              <div class="ml-1">
                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                  </svg>
                              </div>
                          </button>
                      </x-slot>
  
                      <x-slot name="content">
                          <x-dropdown-link :href="route('profile.edit')">
                              {{ __('Profile') }}
                          </x-dropdown-link>
  
                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf
  
                              <x-dropdown-link :href="route('logout')"
                                      onclick="event.preventDefault();
                                                  this.closest('form').submit();">
                                  {{ __('Log Out') }}
                              </x-dropdown-link>
                          </form>
                      </x-slot>
                  </x-dropdown>
              </div>
              </div>

  
                <!--
                  Dropdown menu, show/hide based on menu state.
  
                  Entering: "transition ease-out duration-100"
                    From: "transform opacity-0 scale-95"
                    To: "transform opacity-100 scale-100"
                  Leaving: "transition ease-in duration-75"
                    From: "transform opacity-100 scale-100"
                    To: "transform opacity-0 scale-95"
                -->
              </div>
            </div>
          </div>
        </div>
    </div>
</nav>
</div>

