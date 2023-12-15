<?php

namespace App\Http\Controllers;

use App\Models\UserNotifications;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function showNotifications()
    {
        $notifications = UserNotifications::all();

        return view('notifications.show', compact('notifications'));
    }
}