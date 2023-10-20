<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$package->name_package}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('packages.edit', [$package->id]) }}">Editar</a>
                    <br>
                    Slug {{$package->slug}}<br>
                    Descricao 1 {{$package->food_description}}<br>
                    Descricao 2 {{$package->beverages_description}}<br>
                    <!-- Imagens -->

                    <img src="{{asset('storage/packages/'.$package->photo_1)}}" alt="">
                    <img src="{{asset('storage/packages/'.$package->photo_2)}}" alt="">
                    <img src="{{asset('storage/packages/'.$package->photo_3)}}" alt="">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>