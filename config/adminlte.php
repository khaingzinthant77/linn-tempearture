<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'title' => 'HR',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false, 
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'logo' => 'Linn HR',
    'logo_img' => 'vendor/adminlte/dist/img/linn.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Linn',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

   'classes_auth_card' => '',
    'classes_auth_header' => 'bg-gradient-info',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-lg text-info',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'menu' => [
        [
            'text' => 'search',
            'search' => true,
            'topnav' => true,
        ],
        [
            'text'        => 'Dashboard',
            'icon'        => 'fas fa-tachometer-alt',
            'can'          => 'dashboard',
            // 'label'       => 4,
            // 'label_color' => 'success',
             'submenu' => [
                  [
                    'text'        => 'Main Dashboard',
                    'url'         => 'dashboard',
                    'icon'        => 'fas fa-fw fa-chart-bar',
                    'can'          => 'dashboard'
                    // 'label'       => 4,
                    // 'label_color' => 'success',
                ],
                // [
                //     'text'        => 'HR Dashboard',
                //     'url'         => 'hr-dashboard',
                //     'icon'        => 'fas fa-fw fa-chart-bar',
                //     'can'          => 'dashboard'
                //     // 'label'       => 4,
                //     // 'label_color' => 'success',
                // ],
                //   [
                //     'text'        => 'KPI Dashboard',
                //     'url'         => 'kpi-dashboard',
                //     'icon'        => 'fas fa-fw fa-chart-bar',
                //     'can'          => 'dashboard'
                //     // 'label'       => 4,
                //     // 'label_color' => 'success',
                // ],
             ]
        ],
        [
            'text'    => 'HR Management',
            'icon'    => 'fas fa-fw fa-users',
            'can' => 'employee-list',
            'submenu' => [
                [
                    'text' => 'Employee',
                    'url'  => 'employee',
                    'icon' => 'fas fa-fw fa-user',
                    'can'  => 'employee-list'
                ], 
                // [
                //     'text' => 'Assign Group',
                //     'url'  => 'groups',
                //     'icon' => 'fas fa-fw fa-users',
                //     'can'  => 'employee-list'
                // ],
                // [
                //     'text' => 'Notice Board',
                //     'url'  => 'notice_board',
                //     'icon' => 'fas fa-clipboard',
                // ],

                //  [
                //     'text' => 'RO',
                //     'url'  => 'ro',
                //     'icon' => 'fas fa-fw fa-users',
                //     'can'  => 'ro-list'
                // ] 
            ]
        ],       
        
        // [
        //     'text' => 'change_password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        // [
        //     'text'    => 'Attendance',
        //     'icon'    => 'fa fa-business-time',
        //     'submenu' => [
                
        //         [
        //             'text' => 'Make Attendance',
        //             'url'  => 'attendance',
        //             'icon' => 'fa fa-clock',
        //         ],
        //         // [
        //         //     'text' => 'Actual Time In',
        //         //     'url'  => 'actual_timein',
        //         //     'icon' => 'fa fa-clock',
        //         // ],
        //         // [
        //         //     'text' => 'Late Arrival',
        //         //     'url'  => 'late_arrival',
        //         //     'icon' => 'fa fa-clock',
        //         // ],
        //         [
        //             'text' => 'Leave Application',
        //             'url'  => 'leave_application',
        //             'icon' => 'fa fa-cubes',
        //         ],
        //           [
        //             'text' => 'Day Off',
        //             'url'  => 'offday',
        //             'icon' => 'fas fa-fw fa-calendar-alt',
        //             'can'  => 'offday-list'
        //         ],
        //           [
        //             'text' => 'Overtime',
        //             'url'  => 'overtime',
        //             'icon' => 'fa fa-clock',
        //         ],
        //     ],
        // ],
        //  [
        //     'text'    => 'Performance',
        //     'icon'    => 'fa fa-award',
        //     'submenu' => [
        //         [
        //             'text' => 'Award',
        //             'url'  => 'award',
        //             'icon' => 'fas fa-award',
        //         ],
        //           [
        //             'text' => 'KPI',
        //             'url'  => 'kpi',
        //             'icon' => 'fas fa-trophy',
        //         ],
        //     ],
        // ],

        // [
        //     'text'    => 'Training',
        //     'icon'    => 'fa fa-business-time',
        //     'submenu' => [
                
        //         [
        //             'text' => 'Training',
        //             'url'  => 'training',
        //             'icon' => 'fa fa-university',
        //             'can'  => 'training-list'
        //         ],

        //          [
        //             'text' => 'Training Employee',
        //             'url'  => 'training_emp',
        //             'icon' => 'fa fa-users',
        //             'can'  => 'trainingemployee-list'
        //         ],

        //          [
        //             'text' => 'Training Attendance',
        //             'url'  => 'training_attendance',
        //             'icon' => 'fa fa-transgender-alt',
        //             'can'  => 'trainingattendance-list'
        //         ],

        //          [
        //             'text' => 'Test Result',
        //             'url'  => 'test_result',
        //             'icon' => 'fa fa-list-alt',
        //             'can'  => 'testresult-list'
        //         ],
               
        //     ],
        // ],
        
        [
            'text'    => 'Hostel Management',
            'icon'    => 'fas fa-fw fa-bed',
            'can' => 'hostel-list',
            'submenu' => [
                    
                     

                    
                      [
                                'text' => 'Hostel Employee',
                                'url' => 'hostelemployee',
                                'icon' => 'fas fa-house-user',
                                'can'  => 'hostel-employee-list'
                    ],
                     [
                                'text' => 'Temperature',
                                'url' => 'temperature',
                                'icon' => 'fa fa-thermometer',
                               
                    ],
                ]
        ],

        // [
        //     'text'    => 'Payroll Management',
        //     'icon'    => 'fas fa-fw fa-money-check-alt',
        //     'can' => 'salary-list',
        //     'submenu' => [
        //         [
        //                     'text' => 'Salary',
        //                     'url' => 'salary',
        //                     'icon' => 'fa fa-credit-card',
        //                     'can'  => 'salary-list'
        //         ]
        //     ]
        // ],
        // [
        //     'text'    => 'Recruitment',
        //     'icon'    => 'fas fa-fw fa-briefcase',
        //     'can' => 'job-list',
        //     'submenu' => [
        //         [
        //             'text' => 'Job Openings',
        //             'url' => 'jobopening',
        //             'icon' => 'fa fa-briefcase',
        //             'can'  => 'jobopen-list'
        //         ],
        //         [
        //                     'text' => 'Job Applications',
        //                     'url' => 'jobapplication',
        //                     'icon' => 'fa fa-list-alt',
        //                     'can'  => 'job-list'
        //         ]
        //     ]
        // ],
        [
            'text'    => 'MASTER DATA',
            'icon'    => 'fas fa-fw fa-table',
            'can' => 'nrc-code-list',
            'submenu' => [
                    [
                        'text' => 'Branch',
                        'url'  => 'branch',
                        'icon' => 'fa fa-university',
                        'can'  => 'branch-list'
                    ],
                    [
                                'text' => 'Hostel',
                                'url' => 'hostel',
                                'icon' => 'fa fa-home',
                                'can'  => 'hostel-list'
                    ],
                     [
                                'text' => 'Room',
                                'url' => 'room',
                                'icon' => 'fa fa-th-large',
                                'can'  => 'room-list'
                    ],
                    // [
                    //             'text' => 'Department',
                    //             'url'  => 'department',
                    //             'icon' => 'fa fa-building',
                    //             'can'  => 'department-list'
                    // ],
                    // [
                    //             'text' => 'Position',
                    //             'url'  => 'position',
                    //             'icon' => 'fa fa-sitemap',
                    //             'can'  => 'rank-list'
                    //  ],
                    //  [
                    //             'text' => 'NRC Code',
                    //             'url'  => 'nrccode',
                    //             'icon' => 'fas fa-id-card-alt',
                    //             'can'  => 'nrc-code-list'
                    //  ],
                    //  [
                    //             'text' => 'NRC State',
                    //             'url'  => 'nrcstate',
                    //             'icon' => 'fa fa-id-card',
                    //             'can'  => 'nrc-state-list'
                    //  ],
                    //  [
                    //             'text' => 'Leave Type',
                    //             'url'  => 'leave_type',
                    //             'icon' => 'fa fa-location-arrow',
                    //  ],
                    //  [
                    //             'text' => 'Organization Chart',
                    //             'url'  => 'organization-chart',
                    //             'icon' => 'fa fa-tree',
                    //  ],
                ]
        ],
        [
            'text'    => 'Account Setting',
            'icon'    => 'fas fa-fw fa-users-cog',
            'can' => 'user-list',
            'submenu' => [
                    [
                        'text' => 'Login User',
                        'url'  => 'users',
                        'icon' => 'fas fa-user-plus',
                        'can'  => 'user-list'
                    ],
                    [
                        'text' => 'User Roles',
                        'url'  => 'roles',
                        'icon' => 'fas fa-user-cog',
                        'can'  => 'role-list'
                    ]
            ]
        ],
         
        [
            'text'    => 'System Setting',
            'icon'    => 'fas fa-fw fa-tools',
            'can' => 'setting',
            'submenu' => [
                [
                            'text' => 'Setting',
                            'url'  => 'setting',
                            'icon' => 'fa fa-cogs',
                            'can'  => 'setting'
                ],
                 [
                    'text' => 'Backup',
                    'url'  => 'backup',
                    'icon' => 'fas fa-database',
                    'can'  => 'backup-list'
                 ]
            ]
        ],
        
        
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    */

    'livewire' => false,
];
