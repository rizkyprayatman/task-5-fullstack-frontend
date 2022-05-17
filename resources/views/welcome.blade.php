@extends('layouts.app')

@section('content')
  <div class="container">
                <h1 class="text-center">Blog</h1>
                <div class="row justify-content-start">
                    @foreach ($articles as $article)
                    <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                        <div class="card">
                            <img src="{{ url($article->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="{{ route('show', $article->id) }}" class="text-dark">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                </a>
                                
                            </div>
                            <p class="m-2">Kategori : {{ $article->category->name }} <br> Penulis : {{ $article->user->name }} </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
@endsection
