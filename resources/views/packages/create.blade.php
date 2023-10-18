<h1>Criar Pacote</h1>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data">>

    @csrf

    <input type="text" name="name_package" placeholder="name_package" value="{{old('name_package')}}">
    <input type="text" name="slug" placeholder="slug" value="{{old('slug')}}">
    <textarea name="food_description" id="" cols="30" rows="10" placeholder="food_description"></textarea>{{old('food_description')}}
    <textarea name="beverages_description" id="" cols="30" rows="10" placeholder="beverages_description"></textarea>{{old('beverages_description')}}

    <input type="file" name="images[]" id="">
    <input type="file" name="images[]" id="">
    <input type="file" name="images[]" id="">

    {{-- <input type="text" name="photo_1">
    <input type="text" name="photo_2">
    <input type="text" name="photo_3"> --}}

    <button type="submit">Cadastrar</button>

</form>