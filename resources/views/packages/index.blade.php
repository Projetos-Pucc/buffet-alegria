<h1>Listagem dos pacotes</h1>

<a href="{{ route('packages.create') }}">Criar Pacote</a>
<ul>
    @foreach($packages as $value)
        <li>{{ $value->name_package }}</li>
        <li><a href="{{ route('packages.show', [$value->id])}}">Ir</a></li>
    @endforeach
</ul>