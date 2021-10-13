<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->markAsRead(); //dekat db ada read_at ada tarikh user dah baca

        return view('notification.index', [
            'notifications' => auth()->user()->notifications()->latest()->paginate(10)
        ]);
    }

}
