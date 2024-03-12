@extends('layouts.admin')

@section('content')
    <h1 class="mt-5">Pagamento effettuato con successo!</h1>
    <p>Stai per essere reindirizzato alla pagina principale</p>
    <a class="" href="{{ route('admin.dashboard')}}" role="button">Ritorna alla pagina principale</a>
    <script>
        setTimeout(function(){window.location="http://127.0.0.1:8000/admin/info"}, 3000);
    </script> 
@endsection