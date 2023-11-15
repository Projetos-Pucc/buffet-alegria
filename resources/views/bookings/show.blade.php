<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                

                <p><strong>Nome:</strong> {{ $booking->name_birthdayperson }}</p><br>
                <p><strong>Quantidade de Convidados:</strong> {{ $booking->qnt_invited }}</p><br>
                <p><strong>Pacote Selecionado:</strong> {{ $booking->package['name_package'] }}</p><br>
                <p><strong>Data:</strong> {{ $booking->party_day }}</p><br><br>
                <div class="flex items-center ml-auto float-down">
                    <a href="{{ route('bookings.edit', [$booking->id]) }}" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded">
                        <div class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4">
                            Editar
                        </div>
                    </a>
                </div>

                
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