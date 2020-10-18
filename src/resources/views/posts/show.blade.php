@extends('layouts.app')
@section('content')

<div class="container">
  {{$post -> text}}
  {{$post -> user -> name}}
</div>

@endsection
