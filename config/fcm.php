<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAo_T9tUA:APA91bFNmgmsufceVxAo42Slcl_OphOgz8hsAbxrvtan_VeFpZQSZIWNV3JNQxkCt6zK9oH1vt5VmGseqBEVHhU2HxHSyr3LSXFrFf0ekCMYhha1AtcKK-i0IsvLdw24V09vocHeVzfi'),
        'sender_id' => env('FCM_SENDER_ID', '704189936960'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
