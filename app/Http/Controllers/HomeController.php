<?php

namespace App\Http\Controllers;

use App\Services\ThreadService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $thread_service;

    public function __construct(
        ThreadService $thread_service
    )
    {
        $this->thread_service = $thread_service;
    }

    /**
     * トップ表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // 最新順
        $latest_threads = $this->thread_service->getLatest(config('const.top.latest_threads_limit'));
        // 書き込み数ランキング
        $post_count_ranking_threads = $this->thread_service
            ->getRankingOfPostCount(config('const.top.post_count_ranking_threads_limit'));

        return view('index', compact('latest_threads', 'post_count_ranking_threads'));
    }
}
