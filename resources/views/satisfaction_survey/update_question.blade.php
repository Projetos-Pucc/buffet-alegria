<x-app-layout>

    @include('layouts.header_general')

    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    @endif

                    <form id="form" class="w-full max-w-lg" action="{{ route('survey.update_question', $question->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('put')

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-s font-bold mb-2" for="question">
                                    Pergunta
                                </label>
                                <textarea name="question" id="question" cols="40" rows="10" class="height-500 width-500" placeholder="Insira a questão">{{old('question') ?? $question->question}}</textarea>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">                            
                                <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tipo de pergunta</label>
                                <select name="status" id="status" required>
                                    <option value="invalid" selected disabled>Selecione um formato disponível</option>
                                    @foreach( App\Enums\QuestionType::array() as $key => $value )
                                        <option value="{{$value}}" {{ $question->question_type == $value ? "selected" : ""}}>{{$key}}</option>
                                    @endforeach
                                </select>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
                            </div>
                        </div>

                        <button type="submit" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Editar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.querySelector("#form")

        form.addEventListener('submit', async function(e) {
            e.preventDefault()
            const userConfirmed = await confirm(`Deseja atualizar esta pergunta?`)

            if (userConfirmed) {
                this.submit();
            } else {
                error("Ocorreu um erro!")
            }
        })
        ClassicEditor
            .create(document.querySelector('#question') )
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-app-layout>