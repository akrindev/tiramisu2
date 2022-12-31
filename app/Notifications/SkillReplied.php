<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SkillReplied extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pesan, $skill)
    {
        $this->pesan = $pesan;
        $this->skill = $skill;
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
            'message' => $this->pesan.' di '.$this->skill->name,
            'link' => url('/skill/'.str_replace(' ', '-', $this->skill->skill->name).'/'.str_replace(' ', '-', $this->skill->name)),
        ];
    }
}
