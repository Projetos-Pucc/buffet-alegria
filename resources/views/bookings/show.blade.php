<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Aniversariante {{$booking->name_birthdayperson}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('bookings.edit', [$booking->id]) }}">Editar</a>

                    {{ $booking->id }}
                    {{ $booking->name_birthdayperson }}
                    {{ $booking->qnt_invited }}
                    {{ $booking->package['name_package'] }}
                    {{ $booking->party_start }}
                    {{ $booking->party_end }}

                    @if($booking->status == App\Enums\BookingStatus::A->name)
                    <div>
                        <input type="text" readonly value="{{ route('guests.invite', $booking->id) }}" id="texto">
                        <button type="button" id="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                        </button> 
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#button').addEventListener('click', (e)=>{
            copiarTexto()
        })
        function copiarTexto(){
            let textoCopiado = document.getElementById("texto");
            textoCopiado.select();
            textoCopiado.setSelectionRange(0, 99999)
            document.execCommand("copy");
        }
        copiarTexto()
    </script>
</x-app-layout>