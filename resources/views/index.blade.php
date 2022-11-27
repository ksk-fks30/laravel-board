@extends('layouts.template')

@section('title', 'トップ')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="h2">最新スレッド一覧</h1>
            <table class="table table-bordered mt-4">
                <thead>
                <tr class="text-center">
                    <th scope="col" style="width: 40%;">日時</th>
                    <th scope="col" style="width: 60%;">タイトル</th>
                </tr>
                </thead>
                <tbody>
                @foreach($latest_threads as $thread)
                    <tr>
                        <td>{{ $thread->created_at->format('Y/m/d H:i') }}</td>
                        <td><a href="{{ route('threads.show', $thread->id) }}">{{ $thread->short_title }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <h1 class="h2">投稿数ランキング(Top{{ config('const.top.post_count_ranking_threads_limit') }})</h1>
            <table class="table table-bordered mt-4">
                <thead>
                <tr class="text-center">
                    <th scope="col" style="width: 15%;">順位</th>
                    <th scope="col" style="width: 60%;">タイトル</th>
                    <th scope="col" style="width: 25%;">書き込み数</th>
                </tr>
                </thead>
                <tbody>
                @foreach($post_count_ranking_threads as $thread)
                    <tr>
                        <td class="text-end">{{ $loop->iteration }}</td>
                        <td><a href="{{ route('threads.show', $thread->id) }}">{{ $thread->short_title }}</a></td>
                        <td class="text-end">{{ $thread->posts_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
{{--        <div class="col-sm-4">--}}
{{--            <h1 class="h2">最新の書き込み</h1>--}}

{{--        </div>--}}
    </div>

@endsection
