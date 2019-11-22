<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAo_T9tUA:APA91bEyfid9gKsFJduU9Su02pBYEBFRaUB1lZ-b3KmPWvXdHvOHFef_pUx_hb0ytLoBvQ5i08X_1NZaMv2fIFh_vaNOQoNJGW7U1CmiJm-AqUS2oDhkhF4lZel8IRWo43nfRtuPeaul'),
        'sender_id' => env('FCM_SENDER_ID', '704189936960'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
