@extends('layouts.app')

@section('title') Create @endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('posts.store')}}">  <!-- method is request type(get from doc table) , action is the url to submit the request at -->
        @csrf
        <div class="mb-3">
            <!-- <label for="title" class="form-label">Title</label> -->
            <label class="form-label">Album</label>
            <input type="text" class="form-control" id="albumid" name="album" value="{{old('album')}}">   
        </div>
        <div class="mb-3">
            <!-- <label for="title" class="form-label">Title</label> -->
            <label class="form-label">Artist</label>
            <input type="text" class="form-control" id="artistid" name="artist" value="{{old('artist')}}">   
        </div>
        <div class="mb-3">
            <!-- <label for="artist" class="form-label">Artist</label> -->
            <label class="form-label">Description</label>
            <input class="form-control" rows="3" name='description' value="{{old('description')}}"> </input>
        </div>
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <select class="form-select" aria-label="Default select example" name='genre'>
                <option value="R&B">R&B</option>
                <option value="rap">Trap</option>
                <option value="Rap">Rap</option>
                <option value="Pop">Pop</option>
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Rating</label>
            <select name="rating" class="form-control">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Creator</label>
            <select name="userid" class="form-control">
                @foreach($users as $user)
                    <option value={{$user->id}}>{{$user->name}}</option>
                @endforeach          
            </select>
        </div>
        
        <button class="btn btn-success">Submit</button>
    </form>


@endsection