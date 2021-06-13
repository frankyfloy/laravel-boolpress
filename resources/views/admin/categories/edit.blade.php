@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Modifica Categoria</h3>
        </div>
    </div>



    <div class="row justify-content-center">
        <div class="form-createPost col-4">
            <form action="{{route('admin.category.update',  ['category' => $category->id ])}}" method="post" class="d-flex flex-column text-center" style="width:300px">
                @csrf
                @method('PATCH')

                <div class="form-group d-flex flex-column">
                    <label for="name" class="text-left">Name category</label>
                    <input type="text" name="name" placeholder="Name" value="{{ old('name', $category->name) }}" class="@error('name') is-invalid @enderror">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <input class="mt-3" type="submit" value="Modifica">
            </form>
        </div>
    </div>

</div>
@endsection
