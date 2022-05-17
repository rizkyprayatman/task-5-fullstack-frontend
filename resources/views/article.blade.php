@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="card">
                <img src="{{ asset($articles->image) }}" alt="" class="img-fluid pt-2">
                <div class="card-body">
                    <h1 class="card-title">{{ $articles->title }}</h1>
                    <div class="d-flex my-2">
                        <small class="text-muted">by {{ $articles->user->name }} ・ {{ Carbon\Carbon::parse($articles->created_at)->isoFormat('D MMMM Y'); }}</small>
                    </div>
                    <p>{{ $articles->content }}</p>
                </div>
            </div>
        </div>

        <div aria-label="Page navigation example" class="mt-3">
            <div class="pagination d-flex justify-content-between">
                <li class="page-item"><a class="page-link" href="{{ route('show', $articles->id-1) }}">Previous</a></li>

                <li class="page-item"><a class="page-link" href="{{ route('show', $articles->id+1) }}">Next</a></li>
            </div>
        </div>
    </div>
@endsection
