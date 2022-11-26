<?php

namespace App\Services;

use App\Models\Post;

class PostService extends BaseService
{
    protected string $model = Post::class;

    /**
     * ページネーションで返す
     *
     * @param int $paginate_size
     * @param $filter
     * @param array $with
     * @param string $order_by
     * @param string $sort
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAsPagination(int $paginate_size, $filter, array $with=[], string $order_by='number', string $sort='asc')
    {
        return Post::query()
            ->when(isset($filter['thread_id']), function ($q) use ($filter) {
                $q->where('thread_id', $filter['thread_id']);
            })
            ->orderBy($order_by, $sort)
            ->with($with)
            ->paginate($paginate_size);
    }
}
