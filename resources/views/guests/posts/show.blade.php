@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{route('posts.index')}}">All post</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>
                <div class="card-body">{{ $post->content }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
