<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\CustomNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function testNotificationProcessing()
    {
        // Create a user with a specific time zone
        $user = User::factory()->create([
            'timezone' => 'America/New_York',
        ]);

        // Run the seeder to populate the database with notifications
        Artisan::call('db:seed', ['--class' => 'UserNotificationSeeder']);

        // Mock the notification to prevent actual email sending
        Notification::fake();

        // Run the scheduler to process notifications
        Artisan::call('notifications:process');

        // Assert that the notification class was sent to the user
        Notification::assertSentTo(
            $user,
            CustomNotification::class
        );
    }
}