<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProjectAndTicketNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $item, $type)
    {
        $this->user = $user;
        $this->item = $item;
        $this->type = $type;
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
        if ($this->type === "Assign Project") {
            $message = "You have been assigned to Project: {$this->item->title} (#ID: {$this->item->id})";
        }

        if ($this->type === "Assign Ticket") {
            $message = "You have been assigned to Ticket: {$this->item->title} (#ID: {$this->item->id})";
        }

        return [
            'sender' => $this->user->name(),
            'message' => $message,
        ];
    }
}
