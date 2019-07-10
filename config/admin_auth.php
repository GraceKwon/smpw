<?php

return [
   
    'circuits' => [
        'title' => '순회구관리',
        'submenus' => [
            'zones' => [
                'name' => '구역관리',
                'subpage' => ['구역등록'],
                'auth' => [1,2,3,4,5]
            ],
            'admins' => [
                'name' => '사용자관리',
                'subpage' => ['사용자등록'],
                'auth' => [1,2]
            ],
            'storages' => [
                'name' => '보관장소관리',
                'subpage' => ['보관장소등록'],
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'publishers' => [
        'title' => '봉사자관리',
        'submenus' => [
            'publishers' => [
                'name' => '봉사자관리',
                'subpage' => ['봉사자등록'],
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'acts' => [
        'title' => '봉사일정관리',
        'submenus' => [
            'acts' => [
                'name' => '봉사일정관리',
                'subpage' => ['상세보기'],
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
        'submenus' => [
            'reports' => [
                'name' => '봉사보고관리',
                'subpage' => ['상세보기'],
                'auth' => [1,2,3,4,5]
            ],
            'requests' => [
                'name' => '방문요청관리',
                'subpage' => ['방문요청'],
                'auth' => [1,2,3,4,5]
            ],
            'experiences' => [
                'name' => '경험담관리',
                'subpage' => ['경험담보고'],
                'auth' => [1,2,3]
            ],
        ]
    ],
    
    'products' => [
        'title' => '출판물관리',
        'submenus' => [
            'stocks' => [
                'name' => '출판물재고관리',
                'auth' => [1,2,3,4,5]
            ],
            'orders' => [
                'name' => '출판물신청관리',
                'subpage' => ['출판물신청'],
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],
    
    'statistics' => [
        'title' => '봉사기록통계',
        'submenus' => [
            'STTST_publishers' => [
                'name' => '봉사자통계',
                'auth' => [1,2]
            ],
            'STTST_reports' => [
                'name' => '봉사보고통계',
                'auth' => [1,2]
            ],
            'STTST_products' => [
                'name' => '출판물배부통계',
                'auth' => [1,2]
            ]
        ]
    ],

    'boards' => [
        'title' => '계시판관리',
        'submenus' => [
            'notices' => [
                'name' => '공지사항',
                'subpage' => ['신규등록', '공지사항보기'],
                'auth' => [1,2,3,4,5]
            ]
        ]
    ],

    'latters' => [
        'title' => '메세지함',
        'submenus' => [
            'inbox' => [
                'name' => '받은메세지함',
                'subpage' => ['상세보기'],
                'auth' => [1,2,3,4,5]
            ],
            'sent' => [
                'name' => '보낸메세지함',
                'subpage' => ['글쓰기', '상세보기'],
                'auth' => [1,2,3,4,5]
            ],
            'pushes' => [
                'name' => '푸시메세지발송',
                'auth' => [1,2,3,4,5]
            ],
        ]
    ],



];
