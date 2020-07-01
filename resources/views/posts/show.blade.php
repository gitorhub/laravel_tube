@extends('layouts.app')
@section('content')
<a href="{{route('posts.index')}}" class="btn btn-danger">Go back</a>
<div class="text-center">
    <h2>detail of post id= {{$post->id}}</h2>
    <img src="/storage/cover_images/{{$post->cover_image}}" alt="{{$post->cover_image}}" class="w-25">
    <h4>Post title: {{$post->title}}</h4>
    <p>Post body is: {{$post->body}}</p>
</div>
@auth
@if (Auth::user()->id==$post->user_id)
<div class="d-flex justify-content-around">
    <a href="/posts/{{$post->id}}/edit" class="btn border border-dark">edit</a>
    <form action="{{route('posts.destroy',$post),'edit'}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="DELETE" class="btn border border-dark">
    </form>
</div>    
@endif    
@endauth


@endsection
