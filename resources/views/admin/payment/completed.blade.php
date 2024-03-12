@extends('layouts.admin')

@section('content')
    <p>Pagamento effettuato con successo!</p>
    <a class="btn btn-primary" href="{{ route('admin.dashboard')}}" role="button">Ritorna alla pagina principale</a>
@endsection