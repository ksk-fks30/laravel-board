<?php

namespace App\Http\Controllers;

use App\Exceptions\Thread\NotFoundThreadException;
use App\Http\Requests\StoreThreadRequest;
use App\Models\Thread;
use App\Units\ThreadUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ThreadController extends Controller
{
    private $thread_unit;

    public function __construct(
        ThreadUnit $thread_unit
    )
    {
        $this->thread_unit = $thread_unit;
    }

    /**
     * スレッドの詳細を表示
     *
     * @param Thread $thread
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws NotFoundThreadException
     */
    public function show(Thread $thread)
    {
        if ($thread === null) {
            throw new NotFoundThreadException();
        }

        $posts = $this->thread_unit->post_service
            ->getAsPagination(config('const.thread.paginate_posts_count'), ['thread_id' => $thread->id]);

        return view('thread.show', compact('thread', 'posts'));
    }

    /**
     * スレッド作成画面の表示
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register()
    {
        return view('thread.create');
    }

    /**
     * スレッドを新規登録する
     *
     * @param StoreThreadRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function store(StoreThreadRequest $request)
    {
        $params = $request->all();

        $params['ip_address'] = $request->ip();
        $params['posted_at'] = now();

        DB::beginTransaction();
        try {
            $thread = $this->thread_unit->register($params);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()->withInput()
                ->withErrors([trans('message.error.thread_create_failed')]);
        }

        return redirect(route('threads.show', $thread->id))
            ->with('message', trans('message.success.thread_create'));
    }
}
