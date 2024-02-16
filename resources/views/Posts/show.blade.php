@extends('layouts.app')
@section('title')
post
@endsection


@section('content')

<div class="mt-5">
 <div class="card">
  <h5 class="card-header">{{$post->artist}}</h5>
  <div class="card-body">
    <h5 class="card-title">{{$post->album}}</h5>
    <p class="card-text">{{$post->description}}</p>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
  </div>
</div>

@endsection



 