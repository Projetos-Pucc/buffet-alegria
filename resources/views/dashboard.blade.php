<x-app-layout >
    @include('layouts.header_index')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome Aniversariante</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Máx. Convidados</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Pacote</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Dia da festa</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Inicio</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Fim</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Ações</th>
    
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if($bookings->total() === 0)
                                <tr>
                                    <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhuma reserva encontrada</td>
                                </tr>
                                @else
                                    @foreach($bookings->items() as $key=>$booking)
                                    <tr class="bg-gray-100">
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('bookings.show', [$booking->id]) }}" class="font-bold text-blue-500 hover:underline">{{ $key+1 }}</a>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                            <a href="{{ route('bookings.show', [$booking->id]) }}" class="font-bold text-blue-500 hover:underline">{{ $booking->name_birthdayperson }}</a>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $booking->qnt_invited }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('packages.show', [$booking->package['slug']]) }}" class="font-bold text-blue-500 hover:underline">{{ $booking->package['name_package'] }}</a>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ date('d/m/Y',strtotime($booking->party_day)) }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ date("H:i", strtotime($booking->open_schedule['time'])) }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ date("H:i", strtotime($booking->open_schedule['time']) + $booking->open_schedule['hours'] * 3600) }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
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
                                            <span class="{{ $class }}">{{ App\Enums\BookingStatus::fromValue($booking->status) }}</span>
                                        </td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('bookings.show', $booking->id) }}" title="Visualizar '{{$booking->name_birthdayperson}}'">👁️</a>
                                            @if($booking->status === "P" && $booking->status === "A")
                                                @php
                                                    $date = new DateTime(date('Y-m-d', strtotime($booking->open_schedule['time'] . " +".$min_days." days")));
                                                @endphp
                                                @if($date > new DateTime(date(`Y-m-d`)))
                                                    <a href="{{ route('bookings.edit', $booking->id) }}" title="Editar '{{$booking->name_birthdayperson}}'">✏️</a>
                                                @endif
                                                <form action="{{ route('bookings.delete', $booking->id) }}" method="post" class="inline form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" title="Deletar '{{$booking->name_birthdayperson}}'">❌</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
    
                            </tbody>
                        </table>
                        {{ $bookings->links('components.pagination') }}
                        </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const forms = document.querySelectorAll(".form")

        forms.forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault()
                const userConfirmed = await confirm(`Deseja cancelar esta reserva?`)

                if (userConfirmed) {
                    this.submit();
                }
            })
        });

        const SITEURL = "{{ url('/') }}";

        async function execute(){
            const csrf = document.querySelector('meta[name="csrf-token"]').content
            const data = await axios.get(SITEURL + '/api/survey/get_by_user/{{auth()->user()->id}}', {
                headers: {
                    'X-CSRF-TOKEN': csrf
                }
            })

            if(data.data.length == 0) return;

            const questions = data.data.questions.map((question, index)=>{
                console.log(question)
                if(question.question_type == "M") {
                    return `
                        <div>
                            <p><strong>${question.question}</strong></p>
                            <div>
                                <input required name="rows[q-${question.id}]" type="radio" id="q-${question.id}-1" value="0-25%">
                                <label for="q-${question.id}-1">0-25%</label>
                            </div>
                            <div>
                                <input name="rows[q-${question.id}]" type="radio" id="q-${question.id}-2" value="0-25%">
                                <label for="q-${question.id}-2">26-50%</label>
                            </div>
                            <div>
                                <input name="rows[q-${question.id}]" type="radio" id="q-${question.id}-3" value="26-50%">
                                <label for="q-${question.id}-3">51-75%</label>
                            </div>
                            <div>
                                <input name="rows[q-${question.id}]" type="radio" id="q-${question.id}-4" value="76-100%">
                                <label for="q-${question.id}-4">76-100%</label>
                            </div>
                        </div>
                    `
                } else {
                    return `
                        <div>
                            <label for="q-${question.id}"><strong>${question.question}</strong></label>
                            <br>
                            <textarea required id="q-${question.id}" name="rows[q-${question.id}]"></textarea>
                        </div>
                    `
                }
            })
            const booking = data.data.data.booking

            const data_modal = {
                    title: "Pesquisa de satisfação",
                    content: `
                        <p class="font-size-20px"><strong>Aniversariante ${booking.name_birthdayperson}</strong></p>
                        <br>
                        <form action="{{ route('survey.answer') }}" method="POST">
                            @csrf
                            ${questions.join('<br>')}
                            <input type="hidden" value="${booking.id}" name="booking_id">
                            <br>
                            <button type="submit" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enviar pesquisa</button>
                        </form>
                    `
                }

            html(data_modal)

            console.log(data.data)
        }
        execute()

    </script>
</x-app-layout>
