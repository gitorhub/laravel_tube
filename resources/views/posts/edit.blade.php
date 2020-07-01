@extends('layouts.app')
@section('content')

<h1>Create a Post</h1>

<form action="{{route('posts.update',$post)}}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT');

  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" class="form-control" id="post_title" placeholder="Post Title" name="post_title" value="{{$post->title}}">
  </div>

  <div class="form-group">
    <label for="post_body">Example textarea</label>
    <textarea class="form-control" id="post_body" rows="3" name="post_body" placeholder="Post Body">{{$post->body}}</textarea>
  </div>
  <div class="form-group">
    <input type="file" name="cover_image">
  </div>

  <div class="form-group">
    <input type="submit" value="Edit the Post">
  </div>
</form>


@endsection
