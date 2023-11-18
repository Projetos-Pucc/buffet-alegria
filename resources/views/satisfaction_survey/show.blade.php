<x-app-layout>
    @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p><strong>Pergunta: </strong> {{ $question['questions']->id }}</p><br>
                    @php
                        $class_active = "p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50";
                        $class_unactive = 'p-1.5 text-xs font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50';
                    @endphp
                    <p><strong>Status: </strong> <span class="{{ $question['questions']->status == 1 ? $class_active : $class_unactive }}">{{ $question['questions']->status == 1 ? "Ativado" : "Desativado" }}</span></p><br>
                    <p><strong>Formato: </strong>{{ App\Enums\QuestionType::fromValue($question['questions']->question_type) }}</p><br>
                    <p>{!! $question['questions']->question !!}</p><br>
                    <p><strong>Respostas:</strong></p><br>
                    <div class="overflow-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <!-- w-24 p-3 text-sm font-semibold tracking-wide text-left -->
                                    
                                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">ID</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Resposta</th>
                                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Reserva</th>
    
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if(count($question['answers']) === 0)
                                <tr>
                                    <td colspan="8" class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">Nenhuma recomendação encontrada</td>
                                </tr>
                                @else
                                    @php
                                        $limite_char = 30; // O número de caracteres que você deseja exibir
                                    @endphp
                                    @foreach($question['answers'] as $key=>$value)
                                    <tr class="bg-white">
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $key+1 }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-left">{{ $value->answer }}</td>
                                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                            <a href="{{ route('bookings.show', [$value->booking_id]) }}" class="font-bold text-blue-500 hover:underline">{{ $value->bookings['name_birthdayperson'] }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
    
                            </tbody>
                        </table>
                        {{ $question['answers']->links('components.pagination') }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>