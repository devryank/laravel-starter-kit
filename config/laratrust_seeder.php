<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadmin' => [
            'roles' => 'c,r,u,d', // all permissions
            'permissions' => 'c,r,u,d', // all permissions
            'users' => 'c,r,u,d', // all permissions
        ],
        'admin' => [
            'users' => 'r,u', // read all users and update own profile
        ],
        'user' => [
            'users' => 'r,u', // read and update their own profile
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
