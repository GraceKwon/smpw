<?php

return [
   
    'circuits' => [
        'title' => '순회구 관리',
        'submenus' => [
            'zones' => [
                'name' => '구역 관리',
                'auth' => [1,2,3,4,5]
            ],
            'admins' => [
                'name' => '사용자 관리',
                'auth' => [1,2]
            ],
            'storages' => [
                'name' => '보관장소 관리',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'publishers' => [
        'title' => '봉사자 관리',
        'submenus' => [
            'publishers' => [
                'name' => '봉사자 관리',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'acts' => [
        'title' => '봉사일정 관리',
        'submenus' => [
            'acts' => [
                'name' => '봉사일정 관리',
                'auth' => [1,2,3,4,5]
            ],
            'create' => [
                'name' => '봉사일정 생성',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'reports' => [
        'title' => '봉사보고 관리',
        'submenus' => [
            'reports' => [
                'name' => '봉사일정 관리',
                'auth' => [1,2,3,4,5]
            ],
            'requests' => [
                'name' => '방문요청 관리',
                'auth' => [1,2,3,4,5]
            ],
            'experiences' => [
                'name' => '경험담 보고',
                'auth' => [1,2,3]
            ],
        ]
    ],
    
    'products' => [
        'title' => '출판물 관리',
        'submenus' => [
            'stocks' => [
                'name' => '출판물재고 관리',
                'auth' => [1,2,3,4,5]
            ],
            'orders' => [
                'name' => '출판물 신청',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],
    
    'statistics' => [
        'title' => '봉사기록 통계',
        'submenus' => [
            'STTST_publishers' => [
                'name' => '봉사자 통계',
                'auth' => [1,2]
            ],
            'STTST_reports' => [
                'name' => '봉사보고 통계',
                'auth' => [1,2]
            ],
            'STTST_products' => [
                'name' => '출판물재고 통계',
                'auth' => [1,2]
            ]
        ]
    ],

    'boards' => [
        'title' => '계시판 관리',
        'submenus' => [
            'notices' => [
                'name' => '공지사항',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'latters' => [
        'title' => '메세지함',
        'submenus' => [
            'inbox' => [
                'name' => '보낸 편지함',
                'auth' => [1,2,3,4,5]
            ],
            'sent' => [
                'name' => '받은 편지함',
                'auth' => [1,2,3,4,5]
            ],
            'pushes' => [
                'name' => '푸시메세지 발송',
                'auth' => [1,2,3,4,5]
            ],
        ]
    ],



];
