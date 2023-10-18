<h1>Criar Pacote</h1>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data">>

    @csrf

    <input type="text" name="" placeholder="name_birthdayperson" value="{{old('name_birthdayperson')}}">
    <input type="text" name="years_birthdayperson" placeholder="years_birthdayperson" value="{{old('years_birthdayperson')}}">
    <input type="number" name="qnt_invited" placeholder="qnt_invited" value="{{old('qnt_invited')}}">
    <input type="text" name="id_reservarion" placeholder="id_reservarion" value="{{old('id_reservarion')}}">
    <input type="text" name="id_packages" placeholder="id_packages" value="{{old('id_packages')}}">
    <input type="text" name="status" placeholder="status" value="{{old('status')}}">
    <input type="text" name="user_id" placeholder="user_id" value="{{old('user_id')}}">
    <input type="text" name="package_id" placeholder="package_id" value="{{old('package_id')}}">

    <button type="submit">Cadastrar</button>

</form>