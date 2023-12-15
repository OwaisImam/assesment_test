<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserNotifications;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $this->generateNotificationsForUser($user);
        }
    }

    private function generateNotificationsForUser($user): void
    {
        $scheduledTime = $this->generateRandomTime($user->timezone);
        UserNotifications::insert([
            'user_id' => $user->id,
            'scheduled_at' => $scheduledTime,
            'frequency' => $this->generateRandomFrequency(),
            'notification_message' => '
                Hello  '.$user->name.',
                This is a notification for you. Your email address is: '. $user->email .'
                You have a scheduled event at  '.$scheduledTime.' in your local timezone.
                Thank you for using our notification system.
                Best regards,
                '.env('APP_NAME').'
            ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function generateRandomTime($userTimeZone): string
    {
        $hour = rand(0, 23);
        $minute = rand(0, 59);

        $scheduledAt = Carbon::create(null, null, null, $hour, $minute, 0, $userTimeZone)->format('H:i:s');

        return $scheduledAt;
    }

    private function generateRandomFrequency(): string
    {
        $frequencies = ['daily', 'weekly', 'monthly', 'custom'];

        return $frequencies[array_rand($frequencies)];
    }
}