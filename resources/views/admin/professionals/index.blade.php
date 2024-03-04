@extends('layouts.admin')

@section('content')
    <div class="container">
        <ul class="list-unstyled">
            <li>{{$user->name}}</li>
            <li>{{$user->surname}}</li>
            <li>{{$user->email}}</li>
            @if($professional){
                <li>{{$professional->curriculum}}</li>
                <li>{{$professional->photo}}</li>
                <li>{{$professional->phone}}</li>
                <li>{{$professional->address}}</li>
                <li>{{$professional->performance}}</li>
            }
            @endif
            
             
        </ul>
    </div>
@endsection
