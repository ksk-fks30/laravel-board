@extends('layouts.template')

@section('title', 'スレッドを作る')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="h2">スレッドを作る</h1>

            <div class="card mt-3">
                <div class="card-body">
                    <form method="post" action="{{ route('threads.register') }}"
                          onsubmit="return confirm('本当にこの内容で登録してよろしいですか？');"
                    >
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">タイトル</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">内容</label>
                            <textarea class="form-control" name="body" id="body" rows="15" required>{{ old('body') }}</textarea>
                            <small class="text-muted">※この内容が書き込みの1件目になります。</small>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">登録する</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
