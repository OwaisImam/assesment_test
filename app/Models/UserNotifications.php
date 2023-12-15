<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotifications extends Model
{
    use HasFactory;

    public function getScheduledAt(): string
    {
        return $this->scheduled_at;
    }

    public function getFrequency(): string
    {
        return $this->frequency;
    }

    public function getNotificationMessage(): string
    {
        return $this->notification_message;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}