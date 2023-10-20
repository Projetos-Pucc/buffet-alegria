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
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                    @endif

                    <form class="w-full max-w-lg" action="{{ route('bookings.store') }}" method="POST">

                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_birthdayperson">
                                    Nome do aniversariante
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name_birthdayperson" type="text" placeholder="Guilherme" name="name_birthdayperson" value="{{old('name_birthdayperson')}}">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="years_birthdayperson">
                                    Idade do aniversariante
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="years_birthdayperson" type="number" placeholder="19" name="years_birthdayperson" value="{{old('years_birthdayperson')}}" min="1" step="1">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="qnt_invited">
                                    Quantidade de convidados
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="qnt_invited" type="number" placeholder="0" name="qnt_invited" value="{{old('qnt_invited')}}"  min="1" step="1">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Pacote de comidas
                                </p>
                                @if(count($packages) === 0)
                                    <h1>Nenhum pacote de comida encontrado!</h1>
                                @else
                                    @foreach($packages as $package)
                                        <div>
                                            <input required type="radio" name="package_id" id="package-{{$package['id']}}"  value="{{$package['id']}}">
                                            <label for="package-{{$package['id']}}">{{$package['name_package']}}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        

                        <div>
                            <label for="party_start">Data de começo</label>
                            <input required type="datetime-local" id="party_start" name="party_start">
                        </div>

                        <div>
                            <label for="party_end">Data do fim</label>
                            <input required type="datetime-local" id="party_end" name="party_end">
                        </div>

                        <!-- <div>
                            <p>Preço final: R$ <span id="preco">0</span></p>
                        </div> -->
                        <!--integrar com js dps e fazer o calculo do preço aqui tb! -->

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Agendar Aniversario
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>
</x-app-layout>