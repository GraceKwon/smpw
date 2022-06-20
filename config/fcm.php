<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAUUOOk7I:APA91bE3GfIQ1BrVF7dwKkLOhbXL3JWinh4Lvbcp9zECdaZnpIWmOlqT_OXg6a5J_FgpAn-9H6ABmJ4FFDrq6orzBBL-gMqh_osEf8teLhzu1slRRabKb1aIoFoxZMC0AcYcdUGbrvv8'),
        'sender_id' => env('FCM_SENDER_ID', '349025768370'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
