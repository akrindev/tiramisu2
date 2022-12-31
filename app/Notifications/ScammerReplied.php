<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ScammerReplied extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($q, $thread, $reply)
    {
        $this->q = $q;
        $this->thread = $thread;
        $this->reply = $reply;
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
    public function toArray($notifiable)
    {
        return [
            'by' => explode(' ', auth()->user()->name)[0],
            'message' => $this->q.' '.$this->thread->judul,

            'link' => url('/scammer/r/'.$this->thread->slug.'#reply'.$this->reply->id),
        ];
    }
}
