<?php

namespace App\Listeners;

use App\Events\SomeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class UpdateLastLogin
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
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(user $user)
    {
        ///TODO: FIX. belum ke save last loginnya
        $requestData['last_login'] = Carbon::now();
        $post = Post::findOrFail($user);
        $post->update($requestData);
    }
}
