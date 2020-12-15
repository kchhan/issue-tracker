<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProjectAndTicketNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     * @param (current_user, project/ticket instance, project/ticket type, message type) 
     * @return void
     */
    public function __construct($user, $item, $item_type, $method)
    {
        $this->user = $user;
        $this->item = $item;
        $this->item_type = $item_type;
        $this->method = $method;
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
        if ($this->method == "assign") {
            $message = "{$this->user->name()} has assigned you to {$this->item_type}: {$this->item->title} (#ID: {$this->item->id})";
        }

        if ($this->method == "update") {
            $message = "{$this->user->name()} has updated the {$this->item_type}: #ID: {$this->item->id} to {$this->item->status}";
        }

        if ($this->method == "delete") {
            $message = "{$this->user->name()} has deleted the {$this->item_type}: {$this->item->title}";
        }

        return [
            'message' => $message,
        ];
    }
}
