@extends('layouts.app')

@section('content')
  <div class="continer">
    <div class="row justify-content-center">
        <div class="card mx-5 col-6 ">
            <div class="card-body ">
                <h4 class="card-header">Add Article</h4>
                <form action="/articles" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">					
                        <div class="form-group mt-2">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Content</label>
                            <textarea class="form-control" name="content" id="content" required></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image" id="image" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Category Name</label>
                            <select class="form-select" id="category_id" aria-label="Default select example" name="category_id">
                                <option selected>Choose</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>					
                    </div>
                    <hr>
                    <div class="mt-4 d-flex justify-content-end">
                        <a href="/articles" class="btn btn-default mx-3" >Cancel</a>
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
