<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_not_by_current_user()
    {
        $this->signIn();

        $thread = create('App\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some reply here',
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Some reply here',
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fetch_their_unread_notifications()
    {
        $this->signIn();

        $thread = create('App\Thread')->subscribe();

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Some reply here',
        ]);

        $user = auth()->user();

        $response = $this->getJson("/profiles/{$user->name}/notifications")->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        $this->signIn();

        $thread = create('App\Thread')->subscribe();

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Some reply here',
        ]);

        $user = auth()->user();

        $this->assertcount(1, $user->unreadNotifications);

        $notificationsId = $user->unreadNotifications->first()->id;

        $this->delete("/profiles/{$user->name}/notifications/{$notificationsId}");

        $this->assertcount(0, $user->fresh()->unreadNotifications);
    }
}
