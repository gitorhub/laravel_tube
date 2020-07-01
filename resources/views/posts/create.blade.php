@extends('layouts.app')
@section('content')

<h1>Create a Post</h1>

<form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" class="form-control" id="post_title" placeholder="Post Title" name="post_title">
  </div>

  <div class="form-group">
    <label for="post_body">Example textarea</label>
    <textarea class="form-control" id="post_body" rows="3" name="post_body" placeholder="Post Body"></textarea>
  </div>
  <div class="form-group">
    <input type="file" name="cover_image">
  </div>

  <div class="form-group">
    <input type="submit" value="Add Post">
  </div>

</form>


@endsection
