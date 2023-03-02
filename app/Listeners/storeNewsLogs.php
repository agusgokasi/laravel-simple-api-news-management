<?php

namespace App\Listeners;

use App\Events\NewsLogs;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\NewsLog;

class storeNewsLogs
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
     * @param  \App\Events\NewsLogs  $event
     * @return void
     */
    public function handle(NewsLogs $event)
    {
        NewsLog::create([
            'news_id' => $event->news,
            'user_id' => $event->user,
            'action' => $event->type,
        ]);
    }
}
