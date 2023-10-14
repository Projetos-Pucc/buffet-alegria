<form action="{{ route('packages.store') }}" method="POST">

    @csrf

    <input type="text" name="name_package" placeholder="name_package">
    <input type="text" name="slug" placeholder="slug">
    <textarea name="food_description" id="" cols="30" rows="10" placeholder="food_description"></textarea>
    <textarea name="beverages_description" id="" cols="30" rows="10" placeholder="beverages_description"></textarea>
{{-- 
    <input type="file" name="photo_1" id="">
    <input type="file" name="photo_2" id="">
    <input type="file" name="photo_3" id=""> --}}

    <input type="text" name="photo_1">
    <input type="text" name="photo_2">
    <input type="text" name="photo_3">

    <button type="submit">Cadastrar</button>

</form>