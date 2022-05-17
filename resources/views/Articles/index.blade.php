@extends('layouts.app')

@section('content')
<div class="container">
    <div class="table-wrapper">
        <div class="table-title my-4">
            <div class="row">
                <div class="col-sm-10">
                    <h2>Manage Article</h2>
                </div>
                <div class="col-sm-2">
                    <a href="/articles/create" class="btn btn-primary" ><span>Add New Article</span></a>
                </div>
            </div>
        </div>

        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible show" role="alert">
            <strong>{{ session('delete') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author Name</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    @if ($article->user->id == Auth::user()->id)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td><img src="{{asset($article->image)}}" width="50" height="50" alt="{{ $article->title }}"></td>
                        <td>{{ $article->title }}</td>
                        <td>{{ ($article->user->name) ?? "" }}</td>
                        <td>{{ $article->category->name ?? "" }}</td>
                        <td>
                            <a href="/articles/{{ $article->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                            <form class="d-inline" action="/articles/{{ $article->id }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $articles->links( 'pagination') }}
        </div>
    </div>
</div>
@endsection
