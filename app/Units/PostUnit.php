<?php

namespace App\Units;

use App\Services\PostService;
use Illuminate\Database\Eloquent\Model;

class PostUnit
{
    public $post_service;

    public function __construct(
        PostService $post_service
    )
    {
        $this->post_service = $post_service;
    }

    /**
     * 投稿の新規登録処理
     *
     * @param $params
     * @param $thread
     * @return Model
     */
    public function register($params, $thread): Model
    {
        $number = $this->post_service->maxNumberInThread($thread->id) ?? 0;

        $params['number'] = $number + 1;

        return $this->post_service->create($params);
    }
}
