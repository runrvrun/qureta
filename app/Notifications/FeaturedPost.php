<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class FeaturedPost extends Notification implements ShouldQueue
{
    use Queueable;
    public $title, $body, $url;
    /**
     *
     *
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $body, $url)
    {
        $this->title = $title;
        $this->body = $body;
        $this->url = $url;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }
    public function toWebPush($notifiable, $notification)
    {
      $time = \Carbon\Carbon::now();
        return (new WebPushMessage)
            ->title($this->title)
            ->icon(url('/images/qureta-logo.png'))
            ->body($this->body)
            ->lang($this->url);//ga ada property url, jadi pake lang aja
    }
}
