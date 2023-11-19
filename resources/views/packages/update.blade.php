<x-app-layout>

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

                    <form class="w-full max-w-lg" action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('put')

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_package">
                                    Nome do pacote
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name_package" type="text" placeholder="Pacote Teste" name="name_package" value="{{ old('name_package') ?? $package->name_package }}">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="slug">
                                    Slug
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="slug" type="text" placeholder="nome-com-hifens" name="slug" value="{{old('slug') ?? $package->slug}}">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="qnt_invited">
                                    Descrição das comidas
                                </label>
                                <textarea name="food_description" id="food_description" cols="40" rows="10" class="height-500 width-500" placeholder="food_description">{{ html_entity_decode(old('food_description') ?? $package->food_description) }}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full  px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="qnt_invited">
                                    Descrição das bebidas
                                </label>
                                <textarea name="beverages_description" id="beverages_description" cols="40" rows="10" class="height-500 width-500" placeholder="beverages_description">{{ html_entity_decode(old('beverages_description') ?? $package->beverages_description) }}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="slug">
                                    Preço
                                </label>
                                <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" name ="price" min="0.01" max="10000.00" step="0.01" placeholder="Insira o preco" value="{{ old('price') ?? $package->price }}"/>
                            </div>
                        </div>
                        <!-- <input type="file" name="images[]" id="" accept="image/png, image/gif, image/jpeg" />
                        <input type="file" name="images[]" id="" accept="image/png, image/gif, image/jpeg" />
                        <input type="file" name="images[]" id="" accept="image/png, image/gif, image/jpeg" /> -->

                        <!-- <div>
                            <p>Preço final: R$ <span id="preco">0</span></p>
                        </div> -->
                        <!--integrar com js dps e fazer o calculo do preço aqui tb! -->

                        <button type="submit" class="bg-amber-300 hover:bg-amber-500 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Salvar 
                        </button>
                    </form>

                    <style>
                        .input_file {
                            display: none;
                        }
                    </style>

                    <div class="images bg-yellow-100">
                        <form action="{{ route('packages.update_image', $package->slug) }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            @method('patch')
                            <input type="hidden" name="image_id" value="1">
                            <input type="file" name="photo" id="photo_1" class="input_file" required onchange="this.form.submit()">
                            <label for="photo_1">
                                <img src="{{asset('storage/packages/'.$package->photo_1)}}" alt="foto1">
                            </label>
                        </form>
                        <form action="{{ route('packages.update_image', $package->slug) }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            @method('patch')
                            <input type="hidden" name="image_id" value="2">
                            <input type="file" name="photo" id="photo_2" class="input_file" required onchange="this.form.submit()">
                            <label for="photo_2">
                                <img src="{{asset('storage/packages/'.$package->photo_2)}}" alt="foto2">
                            </label>
                        </form>
                        <form action="{{ route('packages.update_image', $package->slug) }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            @method('patch')
                            <input type="hidden" name="image_id" value="3">
                            <input type="file" name="photo" id="photo_3" class="input_file" required onchange="this.form.submit()">
                            <label for="photo_3">
                                <img src="{{asset('storage/packages/'.$package->photo_3)}}" alt="foto3">
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
        ClassicEditor
            .create(document.querySelector('#food_description'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#beverages_description'))
            .catch(error => {
                console.error(error);
            });
        });
    </script>
</x-app-layout>