<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <div style="width: 50%">
                            <p><strong>Nome:</strong> {{ $booking->name_birthdayperson }}</p><br>
                            <p><strong>Quantidade de Convidados:</strong> {{ $booking->qnt_invited }}</p><br>
                            <p><strong>Pacote Selecionado:</strong> {{ $booking->package['name_package'] }}</p><br>
                            <p><strong>Data:</strong> {{ date('d/m/Y',strtotime($booking->party_day)) }} das {{ date("H:i", strtotime($booking->open_schedule['time'])) }} as {{ date("H:i", strtotime($booking->open_schedule['time']) + $booking->open_schedule['hours'] * 3600) }}</p><br>
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
                            <div>
                                <h1><strong>Quantidade de convidados confirmados:</strong><p>{{$guest_counter['total']}} de {{$guest_counter['unblocked']}}</p></h1>
                                
                            </div>      
                            <p><strong>Status:</strong><span class="{{ $class }}">{{ App\Enums\BookingStatus::fromValue($booking->status) }}</span></p>
                            <br>
                            @php
                                $user = auth()->user();
                                $date = \Illuminate\Support\Carbon::parse($booking->party_day.' '.$booking->open_schedule['time']);
                                $date = $date->subDays($min_days);
                                $date_valid = $date > \Illuminate\Support\Carbon::now();
                            @endphp
                            @if(($booking->status === "P" || $booking->status === "A") && ($user->id === $booking->user_id || $user->hasRole('administrative')) && $date_valid)
                            <form action="{{ route('bookings.delete', $booking->id) }}" method="post" class="inline form">
                                @csrf
                                @method('delete')
                                <button type="submit" title="Deletar '{{$booking->name_birthdayperson}}'" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4">Cancelar Reserva</button>
                            </form>
                            
                            @endif
                            @php
                                // $edit_status = $booking->status === "P" || $booking->status === "A";
                                $edit_permission = $user->id === $booking->user_id || $user->hasRole('administrative') || $user->hasRole('commercial');
                            @endphp
                            @if($edit_permission && $date_valid)
                                <br>
                                <div class="flex items-center ml-auto float-down">
                                    <a href="{{ route('bookings.edit', [$booking->id]) }}" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded">
                                        <div class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4">
                                            Editar
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @if(($booking->status === "A") && auth()->user()->id === $booking->user_id && $date_valid)
                            <br>
                            <h1><strong>Link lista de convidados:</strong></h1>
                            <div class="flex">
                                <style>
                                </style>
                                <input type="text" readonly value="{{ route('guests.invite', $booking->id) }}" class="w-[300px] border-none bg-amber-100 text-amber-700" id="copy-input">
                                <button type="button" id="button" class="border-none h-100 text-white bg-amber-300 sm:px-2 sm:py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="40px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                </button> 
                            </div>
                        @endif
                        </div>

                        <div  style="width: 50%">
                            @php
                            $date = $date->addDays($min_days);
                            $date_valid2 = $date > \Illuminate\Support\Carbon::now();
                            @endphp
                            @if($booking->status === "A" && count($recommendations) !== 0 && $date_valid2)
                                <div>
                                    <h2><strong>Recomendações para a festa:</strong></h2>
                                    @foreach($recommendations as $value)
                                        <p>{!!$value['content']!!}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        @if($booking->status === "F" || $booking->status === "E"  || $booking->status === "A")
                            <br>
                            <h1><strong>Lista de Convidados:</strong></h1>
                            <br>
                            <table class="w-full">
                                <thead class="bg-gray-50 border-b-2 border-gray-200">
                                    <tr>
                                        <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                                        
                                        <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                                        <th class="p-3 text-sm font-semibold tracking-wide text-center">CPF</th>
                                        <th class="p-3 text-sm font-semibold tracking-wide text-center">Idade</th>
                                        <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @if(count($guests) === 0)
                                    <tr>
                                        <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-left">Nenhum convidado encontrado</td>
                                    </tr>
                                    @else
                                        @php
                                            $limite_char = 30; // O número de caracteres que você deseja exibir
                                        @endphp
                                        @foreach($guests as $key=>$value)
                                        <tr class="bg-white">
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $key+1 }}</td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-left">{{ $value['nome'] }}</td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ mb_strimwidth($value['cpf'], 0, $limite_char, " ...") }}</td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ (int)$value['idade'] }}</td>
                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                                <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full  px-3 mb-6 md:mb-0">
                                                    @php
                                                        $date = \Illuminate\Support\Carbon::parse($booking->party_day.' '.$booking->open_schedule['time']);
                                                        // $date = $date->addDays(1);
                                                        $date_valid3 = $date > \Illuminate\Support\Carbon::now();
                                                    @endphp
                                                    @if($booking->status === "A" && $date_valid3)
                                                    <form action="{{route('guests.updateStatus',$value['id'])}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
        
                                                        <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"></label>
                                                        <select name="status" id="status" required onchange="this.form.submit()">
                                                            @foreach( App\Enums\GuestStatus::array() as $key => $status )
                                                                <option value="{{$status}}" {{ $value->status == $status ? 'selected' : ""}}>{{$key}}</option>
                                                            @endforeach
                                                            <!-- <option value="invalid2"  disabled>Nenhum horario disponivel neste dia, tente novamente!</option> -->
                                                        </select>
                                                    </form>
                                                    @else
                                                        {{ App\Enums\GuestStatus::fromValue($value->status) }}
                                                    @endif
                    
                                                    <!-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> -->
                                                </div>
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

    </div>
    <script>
        const btn = document.querySelector('#button')
        if (btn) {
            btn.addEventListener('click', (e) => {
                copiarTexto()
            })
        }
        async function copiarTexto() {
            let textoCopiado = document.getElementById("copy-input");
            textoCopiado.select();
            textoCopiado.setSelectionRange(0, 99999)
            document.execCommand("copy");
            await basic(`Link copiado para a área de transferencia`)
            // alert('Link copiado para a área de transferencia')
        }
    </script>
</x-app-layout>