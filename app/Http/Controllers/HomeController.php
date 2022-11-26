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
        return view('index');
    }
}
