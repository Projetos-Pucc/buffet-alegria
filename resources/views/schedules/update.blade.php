<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atualizar Horario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Horario: {{$schedule->time}} </h1>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    @endif

                    <form class="w-full max-w-lg" action="{{ route('schedules.update', $schedule->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('put')

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="time">
                                    Horário
                                </label>
                                @php
                                    $date = DateTime::createFromFormat('H:i:s', $schedule->time);
                                    $date = $date->format('H:i');

                                    $oldTime = old('time', date('H:i', strtotime($schedule->time)));
                                    // $oldTime = old('time') ? date('H:i', old('time')) : false;
                                @endphp
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="time" type="time" name="time" value="{{ $oldTime ?? $schedule->time }}">
                                <p class="text-gray-600 text-xs">Horário de inicio</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="slug">
                                    Duração
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" name ="hours" min="1" max="5" step="1" placeholder="Insira a duração da festa" value="{{old('hours') ?? $schedule->hours}}"/>
                                <p class="text-gray-600 text-xs">Quantas horas a festa vai durar</p>
                            </div>
                        </div>

                        <button type="submit" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Salvar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>
</x-app-layout>