@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <aside class="d-flex flex-column bg-success">
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
                <a href="{{route('admin.posts.index')}}">Post</a>
                <a href="{{route('admin.posts.index')}}">Users</a>
                <a href="{{route('admin.category.index')}}">Categories</a>
                <a href="{{route('admin.posts.index')}}">Tags</a>
            </aside>
        </div>



        <div class="col-md-8">
            <div class="card">


                <div class="card-header">Pagina principale loggati</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">


                <div class="card-header">Pagina principale loggati</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
