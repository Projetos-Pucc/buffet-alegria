<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 float-left" style="width: 50%;">
                    <a href="{{ route('packages.edit', [$package->id]) }}">Editar</a><br>
                    Slug {{$package->slug}}<br>
                    Descricao 1 {{$package->food_description}}<br>
                    Descricao 2 {{$package->beverages_description}}<br>
                </div>
                <div style="border-right: 3px solid #000; height:100%;"></div>
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