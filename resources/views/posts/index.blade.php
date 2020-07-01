@extends('layouts.app')
@section('content')
@if (count($posts))
<h1>All the Posts</h1>
@foreach ($posts as $post)
<div class="row">
    <div class="col-4">
        <img src="/storage/cover_images/{{$post->cover_image}}" alt="{{$post->cover_image}}" class="w-50">    
    </div>
    <div class="col-8">
        <h1><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></h1>
<small>created at {{$post->created_at}} {{$post->user->name}} </small>
    
    </div>
</div>

@endforeach
<div class="d-flex justify-content-center">
    <p>{{$posts->links()}}</p>
</div>
@else

<div class="alert alert-primary" role="alert">
    hey dude no posts is ready yet
</div>

@endif

@endsection
