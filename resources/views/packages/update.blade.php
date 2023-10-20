<h1>Pacote: {{$package->name_package}} </h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('packages.update', $package->id) }}" method="POST">

    @csrf
    @method('put')
    <input type="text" name="name_package" placeholder="name_package" value="{{$package->name_package}}">
    <input type="text" name="slug" placeholder="slug" value="{{$package->slug}}">
    <textarea name="food_description" id="" cols="30" rows="10" placeholder="food_description">{{$package->food_description}}</textarea>
    <textarea name="beverages_description" id="" cols="30" rows="10" placeholder="beverages_description">{{$package->beverages_description}}</textarea>

    <div>
        <label for="photo_1">
            <img src="{{asset('storage/packages/'.$package->photo_1)}}" alt="">
        </label>
        <input type="file" name="photo_1" id="photo_1" value="">
    </div>
    <div>
    <label for="photo_2">
        <img src="{{asset('storage/packages/'.$package->photo_2)}}" alt="">
        </label>
        <input type="file" name="photo_2" id="photo_2" >
    </div>
    <div>
    <label for="photo_3">
            <img src="{{asset('storage/packages/'.$package->photo_3)}}" alt="">
        </label>
        <input type="file" name="photo_3" id="photo_3" >
    </div>
    
    <button type="submit">Editar</button>

</form>