<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between">
                        <div>

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
                            @if(($booking->status === "P" || $booking->status === "A") && auth()->user()->id === $booking->user_id)
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
                        @if($booking->status === "A")
                        <div>
                            @if(count($recommendations) !== 0)
                                <h2>Recomendações para a festa:</h2>
                                @foreach($recommendations as $value)
                                    <p>{!!$value['content']!!}</p>
                                @endforeach
                            @endif
                        </div>
                        @endif
                    </div>
                    @if($booking->status === "A")
                    <h1>Convidados</h1>
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                                
                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">CPF</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Idade</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if(count($guests) === 0)
                            <tr>
                                <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhum convidado encontrado</td>
                            </tr>
                            @else
                                @php
                                    $limite_char = 30; // O número de caracteres que você deseja exibir
                                @endphp
                                @foreach($guests as $value)
                                <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $value['id'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                    <a href="{{ route('guests.show', [$value['id']]) }}" class="font-bold text-blue-500 hover:underline">{{ $value['nome'] }}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ mb_strimwidth($value['cpf'], 0, $limite_char, " ...") }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ (int)$value['idade'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ App\Enums\GuestStatus::fromValue($value['status']) }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">X</td>
                                </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    {{ $guests->links('components.pagination') }}
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