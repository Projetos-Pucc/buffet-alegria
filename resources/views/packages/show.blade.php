<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 float-left" style="width: 50%; border-right: 3px solid #000000;">
                    <div class="bg-gray-50 border-b-2 border-gray-200">
                        <p>{{ $package->name_package }}</p>
                        <br>
                        <p>Slug {{$package->slug}}</p>
                        <p>Preço {{$package->price}}</p>
                        <br>
                        <p>Descricao das comidas:</p>
                        {!! $package->food_description !!}
                        <br>
                        <br>
                        <p>Descricao das bebidas:</p>
                        {!! $package->beverages_description !!}
                    </div>
                    <br><br>
                    @role('administrative|commercial')
                    <div class="flex items-center ml-auto float-down">
                        <a href="{{ route('packages.edit', [$package->slug]) }}" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded">
                            <div class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4">
                                Editar
                            </div>
                        </a>
                    </div>
                    @endrole
                </div>

                <div class="p-6 text-gray-900 float-right" style="width: 50%;">
                    <!-- Imagens -->
                    <img src="{{asset('storage/packages/'.$package->photo_1)}}" alt="foto1">
                    <img src="{{asset('storage/packages/'.$package->photo_2)}}" alt="foto2">
                    <img src="{{asset('storage/packages/'.$package->photo_3)}}" alt="foto3">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>