<?php

namespace App\Exceptions\Thread;

use Exception;

class NotFoundThreadException extends Exception
{
    public string $redirectTo;
    public $message;

    public function __construct()
    {
        $this->redirectTo = route('index');
        $this->message = 'スレッドが存在しません。';
    }
}
