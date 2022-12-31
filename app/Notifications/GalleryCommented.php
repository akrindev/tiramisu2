<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GalleryCommented extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($q, $gallery, $comment)
    {
        $this->q = $q;
        $this->gallery = $gallery;
        $this->comment = $comment;
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
            'message' => $this->q.' '.str_limit($this->gallery->body, 30),

            'link' => url('/gallery/'.$this->gallery->id.'#reply'.$this->comment->id),
        ];
    }
}
