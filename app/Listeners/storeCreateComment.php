<?php

namespace App\Listeners;

use App\Events\CreateComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Comment;

class storeCreateComment implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreateComment  $event
     * @return void
     */
    public function handle(CreateComment $event)
    {
        Comment::create([
            'user_id' => $event->user,
            'news_id' => $event->news,
            'body' => $event->body,
        ]);
    }
}
