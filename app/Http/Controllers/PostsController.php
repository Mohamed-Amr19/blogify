<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostsController extends Controller
{
    public function index()
    {
        $postsfromDb = Post::all();   //collection object
        //dd($postsfromDb);
        
        return view('posts.index',['posts'=>$postsfromDb]);
    }

    public function show(Post $post)                     //type hinting ,route model binding (modelclassname parameter(name should be same as in route arg)),no query needed
    {
        //dd($post);
        //$singlePost = \App\Models\Post::findorfail($postId);    //model object
        //dd($singlePost->album);
        //$singlePost = \App\Models\Post::where('id',$postId);        //eloquent object
        //$singlePost = \App\Models\Post::where('id',$postId)->first(); // model object with the first hit item (select * from posts where id = $postId limit 1)
        //$singlePost = \App\Models\Post::where('id',$postId)->get();    //collection object with all hit item (select * from posts where id = $postId)
        //$singlePost = \App\Models\Post::where('id',$postId)->get(); 
        //dd($singlePost);

        return view('posts.show',['post'=>$post]);
    }

    public function create()
    {
        $users=User::all();
        // return view('posts.create',['users'=>$users]);
        return view('posts.create',['users'=>$users]);
    }

    public function store()
    {
        //dd($data=$_POST); 
        //dd(request()->all());
        //dd(request());
        request()->validate([
            'album'=>['required','min:2'],
            'artist'=>['required','min:2'],
            'description'=>['required','min:10'],
            'genre'=>'required',
            'rating'=>'required',
            'userid'=>['required','exists:users,id']
        ]);

        $album = request()->album;
        $artist = request()->artist;
        $description = request()->description;
        $genre = request()->genre;
        $rating = request()->rating;
        $postCreator = request()->userid;

        // $post = new Post();
        // $post->album = $album;
        // $post->artist = $artist;
        // $post->description = $description;
        // $post->genre = $genre;
        // $post->rating = $rating;
        
        Post::create([                          //for mass assignment issue                 
            'album'=>$album,
            'artist'=>$artist,
            'description'=>$description,
            'genre'=>$genre,
            'rating'=>$rating,
            'user_id'=>$postCreator
        ]);
        //dd($album,$artist,$description,$genre);


        return to_route('posts.index');
    }

    public function edit(Post $post)
    {
        $users=User::all();
        return view('posts.edit',['post'=>$post,'users'=>$users]);
    }

    public function update($postId)
    {

        request()->validate([
            'album'=>['required','min:2'],
            'artist'=>['required','min:2'],
            'description'=>['required','min:10'],
            'genre'=>'required',
            'rating'=>'required',
            'userid'=>['required','exists:users,id']
        ]);
        
        $album = request()->album;
        $artist = request()->artist;
        $description = request()->description;
        $genre = request()->genre;
        $rating = request()->rating;
        $userid = request()->userid;

        $singlepostfromdb = Post::findorfail($postId);
        $singlepostfromdb ->update([                          //for mass assignment issue                 
            'album'=>$album,
            'artist'=>$artist,
            'description'=>$description,
            'genre'=>$genre,
            'rating'=>$rating,
            'user_id'=>$userid
        ]);
        //dd($album,$artist,$description,$genre);
        return to_route('posts.show',$postId);
    }

    public function destroy(Post $post)
    {
        // $singlepostfromdb = Post::findorfail($postid);

        //dd($post);
        //$singlepostfromdb->delete();
        $post->delete();
       // Post::where('id',$postid)->delete(); //another way to delete all the records with id = $postid

        return to_route('posts.index');
    }
}
