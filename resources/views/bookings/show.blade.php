<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                

                <p><strong>Nome:</strong> {{ $booking->name_birthdayperson }}</p><br>
                <p><strong>Quantidade de Convidados:</strong> {{ $booking->qnt_invited }}</p><br>
                <p><strong>Pacote Selecionado:</strong> {{ $booking->package['name_package'] }}</p><br>
                <p><strong>Data:</strong> {{ $booking->party_day }}</p><br>
                @php
                    $class = '';
                    if ($booking->status === 'A') {
                    $class = "p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50";
                    } elseif ($booking->status === 'P') {
                    $class = "p-1.5 text-xs font-medium uppercase tracking-wider text- q-800 bg-yellow-200 rounded-lg bg-opacity-50";
                    } elseif ($booking->status === 'N' || $booking->status === "C") {
                    $class = 'p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50';
                    } elseif ($booking->status === 'F' || $booking->status === 'E') {
                    $class = 'p-1.5 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-400 rounded-lg bg-opacity-50';
                    } else {
                    $class = 'Valor padrão';
                    }
                @endphp
                <p><strong>Status:</strong><span class="{{ $class }}">{{ App\Enums\BookingStatus::fromValue($booking->status) }}</span></p>
                @if(($booking->status === "P" || $booking->status !== "A") && auth()->user()->id === $booking->user_id)
                    <form action="{{ route('bookings.delete', $booking->id) }}" method="post" class="inline form">
                        @csrf
                        @method('delete')
                        <button type="submit" title="Deletar '{{$booking->name_birthdayperson}}'" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4">Cancelar Reserva</button>
                    </form>
                @endif
                <br><br>
                <div class="flex items-center ml-auto float-down">
                    <a href="{{ route('bookings.edit', [$booking->id]) }}" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded">
                        <div class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4">
                            Editar
                        </div>
                    </a>
                </div>

                @if($booking->status == "A" && auth()->user()->id === $booking->user_id)
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
        const btn = document.querySelector('#button')
        if(btn){
            btn.addEventListener('click', (e)=>{
            copiarTexto()
            })
        }
        async function copiarTexto(){
            let textoCopiado = document.getElementById("texto");
            textoCopiado.select();
            textoCopiado.setSelectionRange(0, 99999)
            document.execCommand("copy");
            await basic(`Link copiado para a área de transferencia`)
            // alert('Link copiado para a área de transferencia')
        }
    </script>
</x-app-layout>