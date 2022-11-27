@extends('layouts.template')

@section('title', $thread->title)

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="">
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

                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="mt-4 border-top">
                <h4 class="mt-4">投稿する</h4>
                <form method="post" action="{{ route('posts.store', $thread->id) }}"
                      onsubmit="return confirm('本当にこの内容で投稿してよろしいですか？');"
                >
                    @csrf
                    <div class="mb-3">
                        <label for="body" class="form-label">内容</label>
                        <textarea class="form-control" name="body" id="body" rows="15"
                                  required>{{ old('body') }}</textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">この内容で投稿</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
