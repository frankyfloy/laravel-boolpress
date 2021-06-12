@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{route('admin.posts.create')}}">Nuovo post</a>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($posts as $post)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>
                    <div class="card-body">{{ $post->content }}</div>
                    <a class="btn-editComic mb-3" href="{{route('posts.show',$post->slug)}}">read more</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
