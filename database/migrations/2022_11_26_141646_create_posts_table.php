<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thread_id')->index();

            $table->text('body')->comment('本文');

            $table->dateTime('posted_at')->index()->comment('投稿日時');
            $table->string('ip_address', 20)->comment('IPアドレス');

            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE posts ADD FULLTEXT index index_body (body) with parser ngram");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
