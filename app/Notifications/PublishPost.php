<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PublishPost extends Notification
{
    use Queueable;

    private $post;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post) {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {        
        return [
            'post_author' => $this->post->post_authors->name,
            'post_title' => $this->post->post_title,
            'post_slug' => $this->post->post_slug,
        ];
    }
}
