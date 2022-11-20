<?php

return [

    'circuits' => [
        'title' => 'circuit management',
        'submenus' => [
            'ServiceZones' => [
                'name' => 'zone',
                'auth' => [1,2,3,4,5],
                'subpage' => ['구역 등록','구역 상세'],
            ],
            'admins' => [
                'name' => 'account',
                'auth' => [1,2],
                'subpage' => ['사용자 등록','사용자 상세'],
            ],
            'KeepZones' => [
                'name' => 'storage place',
                'auth' => [1,2,3,4,5],
                'subpage' => ['보관장소 등록', '보관장소 상세'],
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
        'title' => '봉사일정관리',
        'submenus' => [
            'acts' => [
                'name' => '봉사일정관리',
                'auth' => [1,2,3,4,5],
                'subpage' => '상세보기',
            ],
            'create' => [
                'name' => '봉사일정생성',
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
                'name' => '출판물신청관리',
                'auth' => [1,2,3,4,5],
                'subpage' => '출판물신청',
            ]
        ]
    ],

    'statistics' => [
        'title' => '봉사기록통계',
        'submenus' => [
            'statistic-publishers' => [
                'name' => '봉사자통계',
                'auth' => [1,2,3,4,5]
            ],
            'statistic-monthly-publishers' => [
                'name' => '봉사자월통계',
                'auth' => [1,2,3,4,5]
            ],
            'statistic-reports' => [
                'name' => '봉사보고통계',
                'auth' => [1,2,3,4,5]
            ],
            'statistic-products' => [
                'name' => '출판물통계',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'boards' => [
        'title' => '게시판관리',
        'submenus' => [
            'notices' => [
                'name' => '공지사항',
                'auth' => [1,2,3,4,5],
                'subpage' => ['신규등록', '공지사항보기'],
            ]
        ]
    ],

    'latters' => [
        'title' => '메세지함',
        'submenus' => [
            'inbox' => [
                'name' => '받은메세지함',
                'auth' => [1,2,3,4,5],
                'subpage' => '상세보기',
            ],
            'sent' => [
                'name' => '보낸메세지함',
                'auth' => [1,2,3,4,5],
                'subpage' => ['글쓰기', '상세보기'],
            ],
            // 'pushes' => [
            //     'name' => '푸시메세지발송',
            //     'auth' => [1,2,3,4,5],
            //     'subpage' => ['푸시메세지보내기', '상세보기'],
            // ],
        ]
    ],

];
