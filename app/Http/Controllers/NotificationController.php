<?php

namespace App\Http\Controllers;

use App\Models\User;

class NotificationController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(User $user)
    {
        // $this->authorize('store', $notification)
    }
}
