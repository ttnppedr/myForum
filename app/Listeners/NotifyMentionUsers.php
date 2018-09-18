<?php

namespace App\Listeners;

use App\User;
use App\Notifications\YouWereMentioned;
use App\Events\ThreadReceiveNewReply;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMentionUsers
{
    /**
     * Handle the event.
     *
     * @param  ThreadReceiveNewReply  $event
     * @return void
     */
    public function handle(ThreadReceiveNewReply $event)
    {
        User::whereIn('name', $event->reply->mentionedUsers())->get()
             ->each(function ($user) use ($event) {
                 $user->notify(new YouWereMentioned($event->reply));
             });
    }
}
