@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <a href="{{route('admin.posts.create')}}">Nuovo post</a> --}}
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($categories as $category)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ $category->name }}</div>
                    <div class="card-body"> <img src="https://source.unsplash.com/random/200x200?sig=1" alt=""></div>

                    <div class="card-foot">

                        <div class="d-flex flex-column">
                            <a class="btn-editComic mb-3" href="{{route('admin.category.show',$category->id)}}">View posts</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
