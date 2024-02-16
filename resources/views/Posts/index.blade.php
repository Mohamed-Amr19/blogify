@extends('layouts.app')
@section('title')
index
@endsection

@section('content')
<div class="mt-5">
    <div class="text-center">
        <a href="{{route('posts.create')}}" type="button" class="btn btn-success">Create Post</a>
    </div>
    
</div>
<div class="text-center">
<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Album</th>
      <th scope="col">Artist</th>
      <th scope="col">Genre</th>
      <th scope="col">Rating</th>
      <th scope="col">Creator</th>
    </tr>
  </thead>
  <tbody>
    
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->album}}</td>
      <td>{{$post->artist}}</td>
      <td>{{$post->genre}}</td>
      <td>{{$post->rating}}</td>
      <td>{{$post->user? $post->user->name: 'unknown'}}</td>
      <td>
        <a href="{{route('posts.show',$post['id'])}}" class="btn btn-primary">View</a>
        <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-secondary">Edit</a>
        <form action="{{route('posts.destroy',$post->id)}}" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection


   