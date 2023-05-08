<?php

$menu = json_encode([
    [
        'label' => 'Data Kendaraan',
        'route' => 'kendaraan.index',
        'icon'  => 'bi bi-clipboard-check fs-3',
        'items' => null,
        'permission' => 'kendaraan'
    ],
    [
        'label' => 'User',
        'route' => 'user.index',
        'icon'  => 'bi bi-people fs-3',
        'items' => null,
        'permission' => 'user'
    ],
//    [
//        'label' => 'User Manajemen',
//        'route' => null,
//        'icon'  => 'bi bi-people fs-3',
//        'permission' => 'settings',
//        'items' => [
//            [
//                'label' => 'User',
//                'route' => 'user.index',
//                'permission' => 'settings'
//            ],
//            [
//                'label' => 'Role',
//                'route' => 'role.index',
//                'permission' => 'settings'
//            ],
//            [
//                'label' => 'Permission',
//                'route' => 'permission.index',
//                'permission' => 'settings'
//            ]
//        ]
//    ],
]);

return json_decode($menu);
