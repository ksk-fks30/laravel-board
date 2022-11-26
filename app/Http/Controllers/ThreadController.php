<?php

namespace App\Http\Controllers;

use App\Exceptions\Thread\NotFoundThreadException;
use App\Http\Requests\StoreThreadRequest;
use App\Units\ThreadUnit;
use Illuminate\Http\Request;
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
     * スレッド詳細を表示
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws NotFoundThreadException
     */
    public function show($id)
    {
        $thread = $this->thread_unit->thread_service->find($id);

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
    public function create()
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
    public function register(StoreThreadRequest $request)
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
                ->withErrors(['スレッドの登録に失敗しました。']);
        }

        return redirect(route('threads.show', $thread->id))
            ->with('message', 'スレッドの登録に成功しました。');
    }
}
