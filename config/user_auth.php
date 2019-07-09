<?php

return [
   
    'circuits' => [
        'title' => '순회구관리',
        'sub' => [
            'zones' => [
                'name' => '구역관리',
                'auth' => [1,2,3,4,5]
            ],
            'admins' => [
                'name' => '사용자관리',
                'auth' => [1,2]
            ],
            'storages' => [
                'name' => '보관장소관리',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'publishers' => [
        'title' => '봉사자관리',
        'sub' => [
            'publishers' => [
                'name' => '봉사자관리',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'acts' => [
        'title' => '봉사일정관리',
        'sub' => [
            'acts' => [
                'name' => '봉사일정관리',
                'auth' => [1,2,3,4,5]
            ],
            'create' => [
                'name' => '봉사일정생성',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'reports' => [
        'title' => '봉사보고관리',
        'sub' => [
            'reports' => [
                'name' => '봉사일정관리',
                'auth' => [1,2,3,4,5]
            ],
            'requests' => [
                'name' => '방문요청관리',
                'auth' => [1,2,3,4,5]
            ],
            'experiences' => [
                'name' => '경험담보고',
                'auth' => [1,2,3]
            ],
        ]
    ],
    
    'products' => [
        'title' => '출판물관리',
        'sub' => [
            'stocks' => [
                'name' => '출판물재고관리',
                'auth' => [1,2,3,4,5]
            ],
            'orders' => [
                'name' => '출판물신청',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],
    
    'statistics' => [
        'title' => '봉사기록통계',
        'sub' => [
            'publishers' => [
                'name' => '출판물재고관리',
                'auth' => [1,2]
            ],
            'reports' => [
                'name' => '출판물재고관리',
                'auth' => [1,2]
            ],
            'products' => [
                'name' => '출판물신청',
                'auth' => [1,2]
            ]
        ]
    ],

    'boards' => [
        'title' => '계시판관리',
        'sub' => [
            'notices' => [
                'name' => '공지사항',
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'latters' => [
        'title' => '메세지함',
        'sub' => [
            'inbox' => [
                'name' => '보낸편지함',
                'auth' => [1,2,3,4,5]
            ],
            'sent' => [
                'name' => '받은편지함',
                'auth' => [1,2,3,4,5]
            ],
            'pushes' => [
                'name' => '푸시메세지발송',
                'auth' => [1,2,3,4,5]
            ],
        ]
    ],



];
