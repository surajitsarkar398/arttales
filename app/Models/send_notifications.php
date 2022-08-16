<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class send_notifications extends Model
{
    protected $primaryKey = 'send_notifications_id ';
    protected $fillable = [
        'register_id',
        'requested_id',
        'post_id',
        'comment_id',
        'order_id',
        'send_notification_id',
        'notification_type',
        'notification_time',
        'notification_to',
        'notification_text',
        'image',
    ];
}
