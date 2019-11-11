<?php

return [
   
    'circuits' => [
        'title' => '순회구관리',
        'submenus' => [
            'ServiceZones' => [
                'name' => '구역관리',
                'auth' => [1,2,3,4,5],
                'subpage' => ['구역 등록','구역 상세'],
            ],
            'admins' => [
                'name' => '사용자관리',
                'auth' => [1,2],
                'subpage' => ['사용자 등록','사용자 상세'],
            ],
            'KeepZones' => [
                'name' => '보관장소관리',
                'auth' => [1,2,3,4,5],
                'subpage' => ['보관장소 등록', '보관장소 상세'],
            ]
        ]
    ],

    'publishers' => [
        'title' => '봉사자관리',
        'submenus' => [
            'publishers' => [
                'name' => '봉사자관리',
                'auth' => [1,2,3,4,5],
                'subpage' => ['봉사자 등록', '봉사자 상세'],
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
        'title' => '봉사보고관리',
        'submenus' => [
            'reports' => [
                'name' => '봉사보고관리',
                'auth' => [1,2,3,4,5],
                'subpage' => '상세보기',
            ],
            'requests' => [
                'name' => '방문요청관리',
                'auth' => [1,2,3,4,5],
                'subpage' => '방문요청조회',
            ],
            'experiences' => [
                'name' => '경험담관리',
                'auth' => [1,2,3],
                'subpage' => ['경험담보고'],
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
                'auth' => [1,2,3,4,5],
                'subpage' => ['출판물신청'],
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
                'subpage' => ['상세보기'],
            ],
            'sent' => [
                'name' => '보낸메세지함',
                'auth' => [1,2,3,4,5],
                'subpage' => ['글쓰기', '상세보기'],
            ],
            'pushes' => [
                'name' => '푸시메세지발송',
                'auth' => [1,2,3,4,5]
            ],
        ]
    ],



];
