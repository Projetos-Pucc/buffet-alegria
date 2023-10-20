<h1>Pacote: {{$package->name_package}} </h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('bookings.update', $booking->id) }}" method="POST">

    @csrf
    @method('put')

    <button type="submit">Editar</button>

</form>