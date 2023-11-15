<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$guest->nome}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <br>
                    CPF {{$guest->cpf}}<br>
                    Idade{{$guest->idade}}<br>
                    Reserva: {{$guest->booking_id}}<br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>