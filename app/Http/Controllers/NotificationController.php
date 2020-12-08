<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the notification list.
     * Notifications accessed by $user->unreadNotificatiosn
     */
    public function index()
    {
        return view('notifications.index');
    }

    /**
     * Mark a notification as read
     *
     * @param  \Illuminate\Notifications\DatabaseNotification $notification
     */
    public function update($notification)
    {        
        auth()->user()
            ->unreadNotifications
            ->where('id', $notification)
            ->markAsRead();

        return back();
    }
}
