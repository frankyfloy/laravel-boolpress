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
                    <div class="card-foot">
                        <div class="d-flex flex-column">
                            <a class="btn-readPost mb-3" href="{{route('admin.posts.show',$post->id)}}">read more</a>
                            <a class="btn-editPost mb-3" href="{{route('admin.posts.edit',$post->id)}}">Edit</a>



                            <a class="btn btn-danger"
                               onclick="event.preventDefault();
                               this.nextElementSibling.submit();">
                                Delete
                            </a>

                            <form action="{{route('admin.posts.destroy',$post->id)}}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
