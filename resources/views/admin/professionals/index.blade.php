@extends('layouts.admin')

@section('content')
    <div class="container">
        <button ><a href="{{route('admin.info.edit',$user)}}">Modifica</a></button>
        
        <ul class="list-unstyled">
            <li>{{$user->name}}</li>
            <li>{{$user->surname}}</li>
            <li>{{$user->email}}</li>
            <li>
                @if ( isset($professional->curriculum))
                    <a target="_blank" href="{{ asset('storage/'. $professional->curriculum ) }}">Curriculum vitae</a>
                @else
                    <p>Curriculum assente</p>
                @endif
            
            </li>
            
            <li><img src="{{ asset('storage/'. $professional->photo ) }}" alt="foto assente">
            </li>
            <li>{{$professional->phone ? $professional->phone : 'telefono assente'}}</li>
            <li>{{$professional->address ? $professional->address : 'indirizzo assente'}}</li>
            <li>{{$professional->performance ? $professional->performance : 'descrizione assente'}}</li>

            
             
        </ul>
    </div>
@endsection
