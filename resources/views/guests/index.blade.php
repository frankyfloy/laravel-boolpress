@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home principale Laravel</div>

                <div class="card-body">
                    
                    <a href="{{route('posts.index')}}">Post</a>
                    {{-- <a href="{{route('posts.index')}}">All post</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
