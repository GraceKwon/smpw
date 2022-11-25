<?php

return [

    'circuits' => [
        'title' => 'circuit management',
        'submenus' => [
            'ServiceZones' => [
                'name' => 'zone',
                'auth' => [1,2,3,4,5],
                'subpage' => ['register','detail'],
            ],
            'admins' => [
                'name' => 'account',
                'auth' => [1,2],
                'subpage' => ['register','detail'],
            ],
            'KeepZones' => [
                'name' => 'storage place',
                'auth' => [1,2,3,4,5],
                'subpage' => ['register', 'detail'],
            ]
        ]
    ],

    'publishers' => [
        'title' => 'publisher management',
        'submenus' => [
            'publishers' => [
                'name' => 'publisher',
                'auth' => [1,2,3,4,5],
                'subpage' => ['publisher registration ', 'publisher detail'],
            ]
        ]
    ],

    'acts' => [
        'title' => 'service schedule management',
        'submenus' => [
            'acts' => [
                'name' => 'service schedule',
                'auth' => [1,2,3,4,5],
                'subpage' => 'detail',
            ],
            'create' => [
                'name' => 'register service schedule',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'reports' => [
        'title' => 'service report management',
        'submenus' => [
            'reports' => [
                'name' => 'service report',
                'auth' => [1,2,3,4,5],
                'subpage' => 'detail',
            ],
            'requests' => [
                'name' => 'visit request',
                'auth' => [1,2,3,4,5],
                'subpage' => 'check',
            ],
            'experiences' => [
                'name' => 'experience',
                'auth' => [1,2,3,4,5],
                'subpage' => 'report',
            ],
        ]
    ],

    'products' => [
        'title' => 'publication management',
        'submenus' => [
            'stocks' => [
                'name' => 'inventory of publications',
                'auth' => [1,2,3,4,5],
                'subpage' => 'Inventory quantity',
            ],
            'orders' => [
                'name' => 'Publication request management',
                'auth' => [1,2,3,4,5],
                'subpage' => 'Publication request',
            ]
        ]
    ],

    'statistics' => [
        'title' => 'statistics',
        'submenus' => [
            'statistic-publishers' => [
                'name' => 'publisher statistics',
                'auth' => [1,2,3,4,5]
            ],
            'statistic-monthly-publishers' => [
                'name' => 'publisher monthly statistics',
                'auth' => [1,2,3,4,5]
            ],
            'statistic-reports' => [
                'name' => 'service report statistics',
                'auth' => [1,2,3,4,5]
            ],
            'statistic-products' => [
                'name' => 'Publication statistics',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'boards' => [
        'title' => 'Notice management',
        'submenus' => [
            'notices' => [
                'name' => 'Notice',
                'auth' => [1,2,3,4,5],
                'subpage' => ['register', 'view'],
            ]
        ]
    ],

    'latters' => [
        'title' => 'Inbox',
        'submenus' => [
            'inbox' => [
                'name' => 'Inbox',
                'auth' => [1,2,3,4,5],
                'subpage' => 'detail',
            ],
            'sent' => [
                'name' => 'Sent',
                'auth' => [1,2,3,4,5],
                'subpage' => ['writing', 'view'],
            ],
            // 'pushes' => [
            //     'name' => '푸시메세지발송',
            //     'auth' => [1,2,3,4,5],
            //     'subpage' => ['푸시메세지보내기', '상세보기'],
            // ],
        ]
    ],

];
