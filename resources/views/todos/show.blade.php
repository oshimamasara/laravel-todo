@extends('base')

@section('main')
<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3">Todoの確認</h1>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">ID： {{$todo->id}}</li>
            <li class="list-group-item">Todo： {{$todo-> title}}</li>
            <li class="list-group-item">メモ： {{$todo-> memo}}</li>
        </ul>
    </div>
</div>
<hr>
<a href="{{ route('todos.index')}}">もどる</a>
@endsection