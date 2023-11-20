<x-app-layout>
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
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">CPF</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Idade</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Status</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Booking</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Alterar Status</th>


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
                                @foreach($guests as $key=>$values)
                                <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $key+1 }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ $values['nome'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ mb_strimwidth($values['cpf'], 0, $limite_char, " ...") }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ (int)$values['idade'] }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">{{ App\Enums\GuestStatus::fromValue($values->status) }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <a href="{{route('bookings.show', [$values['booking_id']])}}" class="font-bold text-blue-500 hover:underline">{{ $values['booking']['name_birthdayperson']}}</a>
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full  px-3 mb-6 md:mb-0">

                                            <form action="{{route('guests.updateStatus',$values['id'])}}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"></label>
                                                <select name="status" id="status" required onchange="this.form.submit()">
                                                    @foreach( App\Enums\GuestStatus::array() as $key => $value )
                                                        <option value="{{$value}}" {{ $values->status == $value ? 'selected' : ""}}>{{$key}}</option>
                                                    @endforeach
                                                    <!-- <option value="invalid2"  disabled>Nenhum horario disponivel neste dia, tente novamente!</option> -->
                                                </select>
                                            </form>
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
            
                                            <!-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> -->
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    {{ $guests->links('components.pagination') }}
                    </div>

                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>