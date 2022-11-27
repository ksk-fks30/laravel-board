<?php

namespace App\Http\Controllers;


use App\Exceptions\Thread\NotFoundThreadException;
use App\Http\Requests\StorePostRequest;
use App\Models\Thread;
use App\Units\PostUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    private $post_unit;

    public function __construct(
        PostUnit $post_unit
    )
    {
        $this->post_unit = $post_unit;
    }

    /**
     * 投稿する
     *
     * @param StorePostRequest $request
     * @param Thread $thread
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function store(StorePostRequest $request, Thread $thread)
    {
        if ($thread === null) {
            throw new NotFoundThreadException();
        }

        $params = $request->all();

        $params['thread_id'] = $thread->id;
        $params['ip_address'] = $request->ip();
        $params['posted_at'] = now();

        DB::beginTransaction();
        try {
            $post = $this->post_unit->register($params, $thread);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()->withInput()
                ->withErrors([trans('message.error.post_create_failed')]);
        }

        return redirect(route('threads.show', $thread->id))
            ->with('message', trans('message.success.post_create'));
    }
}
