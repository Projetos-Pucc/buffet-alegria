<x-app-layout>
   @include('layouts.header_general')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    @endif

                    <form class="w-full max-w-lg" action="{{ route('schedules.store') }}" method="POST" enctype="multipart/form-data" id="form">

                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="time">
                                    Horário
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="time" type="time" name="time" value="{{old('time')}}">
                                <p class="text-gray-600 text-xs">Horário de inicio</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="slug">
                                    Duração
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" name ="hours" min="1" max="5" step="1" placeholder="Insira a duração da festa" value="{{ old('hours') }}"/>
                                <p class="text-gray-600 text-xs">Quantas horas a festa vai durar</p>
                            </div>
                        </div>

                        <button type="submit" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Criar Horário
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.querySelector("#form")
        const time = document.querySelector("#time")

        form.addEventListener('submit', async function(e) {
            e.preventDefault()
            const userConfirmed = await confirm(`Deseja criar o horário ${time.value}?`)

            if (userConfirmed) {
                this.submit();
            } else {
                error("Ocorreu um erro!")
            }
        })
    </script>
</x-app-layout>