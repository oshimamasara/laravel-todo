@extends('base')

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Todo 追加</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('todos.store') }}">
          @csrf
          <div class="form-group">    
              <label for="title">タイトル:</label>
              <input type="text" class="form-control" name="title"/>
          </div>

          <div class="form-group">
              <label for="memo">メモ:</label>
              <input type="text" class="form-control" name="memo"/>
          </div>

          <button type="submit" class="btn btn-primary">追加</button>
      </form>
  </div>
</div>
</div>
@endsection