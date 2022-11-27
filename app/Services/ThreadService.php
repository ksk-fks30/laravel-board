<?php

namespace App\Services;

use App\Models\Thread;

class ThreadService extends BaseService
{
    protected string $model = Thread::class;

    /**
     * 最新のスレッドを指定件数分取得する
     *
     * @param int $limit
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getLatest(int $limit, array $with=[])
    {
        return Thread::query()
            ->latest('created_at')
            ->limit($limit)
            ->with($with)
            ->get();
    }

    /**
     * 投稿数ランキングを取得
     *
     * @param int $limit
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getRankingOfPostCount(int $limit, array $with=[])
    {
        return Thread::query()
            ->withCount('posts')
            ->latest('posts_count')
            ->limit($limit)
            ->with($with)
            ->get();
    }
}
