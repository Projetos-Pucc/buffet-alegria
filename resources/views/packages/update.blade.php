<h1>Pacote: {{$package->name_package}} </h1>

<form action="{{ route('packages.update', $package->id) }}" method="POST">

    @csrf
    @method('put')
    <input type="text" name="name_package" placeholder="name_package" value="{{$package->name_package}}">
    <input type="text" name="slug" placeholder="slug" value="{{$package->slug}}">
    <textarea name="food_description" id="" cols="30" rows="10" placeholder="food_description">{{$package->food_description}}</textarea>
    <textarea name="beverages_description" id="" cols="30" rows="10" placeholder="beverages_description">{{$package->beverages_description}}</textarea>
{{-- 
    <input type="file" name="photo_1" id="" value="{{$package->photo_1}}">
    <input type="file" name="photo_2" id="" value="{{$package->photo_2}}">
    <input type="file" name="photo_3" id="" value="{{$package->photo_3}}"> --}}

    <input type="text" name="photo_1" value="{{$package->photo_1}}">
    <input type="text" name="photo_2" value="{{$package->photo_2}}">
    <input type="text" name="photo_3" value="{{$package->photo_3}}">

    <button type="submit">Editar</button>

</form>