@extends('layouts.template')

@section('title', $thread->title)

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="h2">{{ $thread->title }}</h1>

            @foreach($posts as $post)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->number }}. </h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $post->posted_at }}</h6>
                        <p class="card-text">{!! nl2br(e($post->body)) !!}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection
