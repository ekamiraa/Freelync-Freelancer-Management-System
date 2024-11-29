<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        // Change notification to MarkAsRead
        auth()->user()->unreadNotifications->markAsRead();

        return view('layouts.both.notification', compact('notifications'));
    }
}
