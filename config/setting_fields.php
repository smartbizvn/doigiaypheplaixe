<?php
return [
    'contact' => [
        'title' => 'THÔNG TIN LIÊN HỆ',
        'desc' => 'Email settings for app',
        'icon' => 'las la-info-circle',

        'elements' => [
            [
                'type' => 'text',
                'data' => 'string', 
                'name' => 'website_name',
                'label' => 'Tên trang web',
                'rules' => 'required',
                'placeholder' => 'Tên trang web'
            ],
            [
                'type' => 'text',
                'data' => 'string', 
                'name' => 'co_quan_chu_quan',
                'label' => 'Cơ quan chủ quản',
                'rules' => 'required',
                'placeholder' => 'Cơ quan chủ quản'
            ],
            [
                'type' => 'text',
                'data' => 'string', 
                'name' => 'nguoi_phat_ngon',
                'label' => 'Người phát ngôn',
                'rules' => 'required',
                'placeholder' => 'Người phát ngôn'
            ],
            [
                'type' => 'text',
                'data' => 'string', 
                'name' => 'truong_ban_bien_tap',
                'label' => 'Trưởng ban biên tập',
                'rules' => 'required',
                'placeholder' => 'Trưởng ban biên tập'
            ],
            [
                'type' => 'text',
                'data' => 'string', 
                'name' => 'phone',
                'label' => 'Điện thoại',
                'rules' => 'required',
                'placeholder' => 'Điện thoại'
            ],
            [
                'type' => 'text',
                'data' => 'string', 
                'name' => 'email',
                'label' => 'Địa chỉ Email',
                'rules' => 'required',
                'placeholder' => 'Địa chỉ Email'
            ],
            [
                'type' => 'text',
                'data' => 'string', 
                'name' => 'address',
                'label' => 'Địa chỉ',
                'rules' => 'required',
                'placeholder' => 'Địa chỉ'
            ]
        ]
    ],

    'seo' => [
        'title' => 'CẤU HÌNH SEO',
        'desc' => 'Cấu hình SEO',
        'icon' => 'las la-check-square',

        'elements' => [
            [
                'type' => 'text',
                'name' => 'title',
                'label' => 'Tiêu đề',
                'rules' => 'required',
                'placeholder' => 'Tiêu đề'
            ],
            [
                'type' => 'text',
                'name' => 'meta_keyword',
                'label' => 'Meta Keyword',
                'rules' => 'required',
                'placeholder' => 'Meta Keyword'
            ],
            [
                'type' => 'textarea',
                'name' => 'meta_description',
                'label' => 'Meta Description',
                'rules' => 'required',
                'placeholder' => 'Meta Description'
            ]
        ]
    ],

    'code' => [
        'title' => 'NHÚNG CODE',
        'desc' => 'Email settings for app',
        'icon' => 'las la-code',

        'elements' => [
            [
                'type' => 'textarea',
                'name' => 'in_head',
                'label' => 'Trong thẻ <head>',
                'rules' => '',
                'placeholder' => 'Mã code'
            ],
            [
                'type' => 'textarea',
                'name' => 'top_body',
                'label' => 'Dưới thẻ <body>',
                'rules' => '',
                'placeholder' => 'Mã code'
            ] ,
            [
                'type' => 'textarea',
                'name' => 'botom_body',
                'label' => 'Trên thẻ </body>',
                'rules' => '',
                'placeholder' => 'Mã code'
            ]
        ]
    ],
];