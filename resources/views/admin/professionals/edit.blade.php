@extends('layouts.admin')

@section('content')


  <div class="my-3">
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="list-unstyled">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
  </div>
  
 <form class="row g-3 my-3" action=" {{route('admin.info.update',$user)}}" method="POST" enctype="multipart/form-data">
  @csrf

  @method('PUT')
  
  <div class="col-12">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name)}}" required>
  </div>
  <div class="col-12">
    <label for="surname" class="form-label">Cognome</label>
    <input type="text" class="form-control" id="surname" name="surname" value="{{old('surname', $user->surname)}}"  required>
  </div>
  
  
   <div class="input-group my-4">
                    <input type="file" class="form-control" id="curriculum" name="curriculum">
                    <label class="input-group-text" for="curriculum">Carica CV</label>
    </div>

     <div class="input-group my-4">
                    <input type="file" class="form-control" id="photo" name="photo">
                    <label class="input-group-text" for="photo">Carica foto</label>
    </div>
  <div class="col-12">
    <label for="phone" class="form-label">Telefono</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone', $user->$professional?->phone)}}"  >
  </div>

  <div class="col-12">
    <label for="address" class="form-label">Indirizzo</label>
    <input type="text" class="form-control" id="address" name="address" value="{{old('address', $user->$professional?->address)}}"  >
  </div>

  
  <div class="col-12">
    <label for="address" class="form-label">Descrizione</label>
    <div class="form-floating">
      <textarea name="performance" id="performance" cols="30" rows="10" class="form-control p-1" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">
        {{old('address', $user->$professional?->performance)}}
      </textarea>
      
  </div>
    

  </div>
  
  
    <button type="submit" class="btn btn-primary">Invia</button>
  </div>
</form>
@endsection