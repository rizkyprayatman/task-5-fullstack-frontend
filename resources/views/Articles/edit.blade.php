@extends('layouts.app')

@section('content')
  <div class="continer">
    <div class="row justify-content-center">
        <div class="card mx-5 col-6 ">
            <div class="card-body ">
                <h4 class="card-header">Edit Article</h4>
                <form action="/articles/{{ $article->id }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                    @csrf
                    <div class="card-text pt-3">					
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control" name="content" id="content" required>{{ old('content', $article->content) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="hidden" name="oldImage" value="{{ $article->image }}">
                                @if ($article->image)
                                    <img class="d-block mb-3" src="{{url($article->image)}}" width="100px" height="100px" alt="">
                                @endif
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <select class="form-select" id="category_id" aria-label="Default select example" name="category_id" value="{{ old('category_id', $article->category_id) }}">
                                <option selected>Choose</option>
                                @foreach ($categories as $category)
                                @if(old('category_id', $article->category_id) == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else 
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>					
                    </div>
                    <hr>
                    <div class="mt-4 d-flex justify-content-end">
                        <a href="/articles" class="btn btn-default mx-3" >Cancel</a>
                        <input type="submit" class="btn btn-success" value="Edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
