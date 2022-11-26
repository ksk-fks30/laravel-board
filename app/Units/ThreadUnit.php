<?php

namespace App\Units;

use App\Services\PostService;
use App\Services\ThreadService;
use Illuminate\Database\Eloquent\Model;

class ThreadUnit
{
    public $thread_service;
    public $post_service;

    public function __construct(
        ThreadService $thread_service,
        PostService $post_service
    )
    {
        $this->thread_service = $thread_service;
        $this->post_service = $post_service;
    }

    /**
     * スレッドの新規登録処理
     *
     * @param $params
     * @return Model
     */
    public function register($params): Model
    {
        // スレッドを作成
        $thread = $this->thread_service->create($params);

        // 1件目の投稿作成
        $params['thread_id'] = $thread->id;
        $params['number'] = 1;

        $this->post_service->create($params);

        return $thread;
    }
}
