@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are logged in! Dear <strong>{{ Auth::user()->name }}</strong>
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>Post Name</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>                          
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->title}} -by {{$post->user->name}}</td>
                                <td><a href="{{route('posts.edit',$post,'edit')}}" class="btn border border-dark">Edit</a></td>
                                <td>
                                    <form action="{{route('posts.destroy',$post)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="DELETE" class="btn border border-dark">
                                    </form>
                                </td>

                            </tr>
                        </tbody>
                        @endforeach

                    </table>



                    <nav class="navbar navbar-expand-lg navbar-light bg-light">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item"><a class="nav-link" href="{{route('posts.create')}}">Create a
                                        post</a></li>
                            </ul>

                        </div>
                    </nav>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
