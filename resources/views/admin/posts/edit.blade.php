@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Nuovo post</h3>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="form-createPost col-8">
            <form action="{{route('admin.posts.update', ['post' => $post->id ])}}" method="post" class="d-flex flex-column">
                @csrf
                @method('PATCH')

                <div class="form-group d-flex flex-column">
                    <label for="category">Category</label>
                    <select value="{{old('title')}}" class="form-control @error('category') is-invalid @enderror" id="category" name="category_id">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                                {{$category->id == old('category->id', $post->category_id) ?  'selected' : '' }}
                                >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group d-flex flex-column">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Title" value="{{ old('title', $post->title) }}" class="@error('title') is-invalid @enderror">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group d-flex flex-column">
                    <label class="mt-3" for="content">Description</label>
                    <textarea name="content" placeholder="Content" class="@error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <input class="mt-3" type="submit" value="Modifica">
            </form>
        </div>
    </div>

</div>
@endsection
