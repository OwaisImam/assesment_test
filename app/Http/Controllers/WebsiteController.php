<?php

namespace App\Http\Controllers;

use App\Models\UserNotifications;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    // For show queued notifications
    public function showNotifications()
    {
        // Fetch all queued notifications
        $notifications = UserNotifications::all();

        return view('notifications.show', compact('notifications'));
    }
}