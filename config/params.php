<?php

return [
    'cdnSite' => '//xcdn.webstart.in.ua/',
    'adminEmail' => 'admin@example.com',
    'thumbnails' => [
        'user' => [
            'medium' => ['width' => 800, 'height' => 600, 'crop' => false, 'suffix' => '_m'],
            'small' => ['width' => 130, 'height' => 87, 'crop' => true, 'suffix' => '_s'],
            'bigicon' => ['width' => 200, 'height' => 200, 'crop' => true, 'suffix' => '_ib'],
            'icon' => ['width' => 100, 'height' => 100, 'crop' => true, 'suffix' => '_im'],
            'smallicon' => ['width' => 50, 'height' => 50, 'crop' => true, 'suffix' => '_is'],
        ],
        'post' => [
            'medium' => ['width' => 800, 'height' => 600, 'crop' => false, 'suffix' => '_m'],
            'small' => ['width' => 130, 'height' => 87, 'crop' => true, 'suffix' => '_s'],
        ]
    ]
];
