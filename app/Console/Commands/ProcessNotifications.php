<?php

namespace App\Console\Commands;

use App\Models\UserNotifications;
use App\Notifications\CustomNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ProcessNotifications extends Command
{
    protected $signature = 'notifications:process';
    protected $description = 'Process scheduled notifications';

    public function handle()
    {
        $notifications = UserNotifications::where('scheduled_at', '<=', now())
            ->get();

        foreach ($notifications as $notification) {
            if ($this->shouldProcessNotification($notification)) {
                $this->processNotification($notification);
            }
        }
    }

    private function shouldProcessNotification($notification)
    {
        $scheduledAt = Carbon::parse($notification->scheduled_at)->timezone($notification->user->timezone);

        switch ($notification->frequency) {
            case 'daily':
                return $scheduledAt->isToday();
            case 'weekly':
                return $scheduledAt->isSameDay(now());
            case 'monthly':
                return $scheduledAt->isSameMonth(now());
            default:
                return false;
        }
    }

    private function processNotification($notification): void
    {
        $notification->user->notify(new CustomNotification($notification->notification_message));

        Log::info('Notification processed', [
            'user_id' => $notification->user_id,
            'scheduled_at' => $notification->scheduled_at,
            'frequency' => $notification->frequency,
        ]);
    }
}