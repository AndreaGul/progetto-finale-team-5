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
  
 <form class="row g-3 my-3" action=" {{route('admin.info.update',$user)}}" method="POST">
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
                    <input type="file" class="form-control" id="inputGroupFile02" name="curriculum">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
  
  
    <button type="submit" class="btn btn-primary">Invia</button>
  </div>
</form>
@endsection