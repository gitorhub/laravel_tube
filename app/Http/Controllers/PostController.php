<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except'=>['index', 'show']]);
        $this->middleware('auth')->except(['index', 'show']);
    }

    
//////////////////////////

    public function index()
    {
        // $posts= Post::all();
        // return Post::where('title',"title one")->get();
        // return Post::orderBy('title', 'asc')->take(1)->get();
        // return Post::orderBy('title', 'desc')->get();
        $posts= Post::orderBy('id', 'desc')->paginate(3);
        return view('posts.index', ['posts'=> $posts]);
    }

//////////////////////////

    public function create()
    {
        return view('posts.create');
    }

//////////////////////////

    public function store(Request $request)
    {
        $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        //handle file
        if($request->hasFile('cover_image')){

            $filenamewithExt=$request->file('cover_image')->getClientOriginalName();
            $extention=$request->file('cover_image')->getClientOriginalExtension();
            $filename=pathinfo($filenamewithExt, PATHINFO_FILENAME); //PHP OLAYI
            $filenametoStore=$filename.'_'.time().'.'.$extention; //aynı isismde başka resim yüklemek için
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$filenametoStore);

        }else{
            $filenametoStore='noimage.jpg';
        }
        $post=new Post();
        $post->title=request('post_title');
        $post->body=request('post_body');
        $post->user_id=auth()->user()->id;
        $post->cover_image=$filenametoStore;
        $post->save();

        return redirect('/posts')->with('success','Added Succesfully');    
    }

//////////////////////////

    public function show(Post $post)
    {
        return view('posts.show')->with('post',$post);
    }

//////////////////////////

    public function edit(Post $post)
    {
        if(auth()->user()!=$post->user){
            return redirect('posts')->with('error', 'you must login to edit the post');
        }
        return view('posts.edit')->with('post',$post);
    }

//////////////////////////

    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required'
        ]);
        if($request->hasFile('cover_image')){

            $filenamewithExt=$request->file('cover_image')->getClientOriginalName();
            $extention=$request->file('cover_image')->getClientOriginalExtension();
            $filename=pathinfo($filenamewithExt, PATHINFO_FILENAME); //PHP OLAYI
            $filenametoStore=$filename.'_'.time().'.'.$extention; //aynı isismde başka resim yüklemek için
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$filenametoStore);

        }
        $post->title=request('post_title');
        $post->body=request('post_body');
        if($request->hasFile('cover_image')){
            $post->cover_image=$filenametoStore;        }
        $post->save();

        return redirect('/posts')->with('success','Updated Succesfully');     
    }

//////////////////////////

    public function destroy(Post $post)
    {
        if(auth()->user()!=$post->user){
            return redirect('posts')->with('error', 'you must login to delete the post');
        }

        if($post->cover_image!='noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
     $post->delete();
     return redirect('/posts')->with('success','Deleted Succesfully');     
    }
}