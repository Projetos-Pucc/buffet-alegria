<a href="{{ route('packages.edit', [$package->id]) }}">Editar</a>
<br>
Produto {{$package->name_package}}<br>
Slug {{$package->slug}}<br>
Descricao 1 {{$package->food_description}}<br>
Descricao 2 {{$package->beverages_description}}<br>
<!-- Imagens -->

<img src="{{asset('storage/packages/'.$package->photo_1)}}" alt="">
<img src="{{asset('storage/packages/'.$package->photo_2)}}" alt="">
<img src="{{asset('storage/packages/'.$package->photo_3)}}" alt="">