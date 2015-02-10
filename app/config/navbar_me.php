<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Menu structure with menu and sub-menu items
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => '<i class="fa fa-home"></i> Home',
            'url'   => '',
            'title' => 'Home'
        ],
        
 
        // This is a menu item
        'question'  => [
            'text'  => '<i class="fa fa-question"></i> Questions',
            'url'   => 'question',
            'title' => 'Questions and answers'
        ],
        
         // This is a menu item
        'tags'  => [
            'text'  => '<i class="fa fa-tags"></i> Tags',
            'url'   => 'question/alltags',
            'title' => 'Tags'
        ],
        
         'database'  => [ 
            'text'  => '<i class="fa fa-user"></i> Users',    
            'url'   => $this->di->get('url')->create('users/list'),    
            'title' => 'User database'
         ],
        
        /*
         //This is a menu item 
        'database'  => [ 
            'text'  => '<i class="fa fa-user"></i> Users',    
            'url'   => 'users/list',    
            'title' => 'User database',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'item 1'  => [
                        'text'  => 'List',
                        'url'   => 'users/list',
                        'title' => 'List all users'
                    ],
                    'item 2'  => [
                        'text'  => 'Active users',
                        'url'   => 'users/active',
                        'title' => 'Active users'
                    ],
                    'item 3'  => [
                        'text'  => 'Inactive users',
                        'url'   => 'users/inactive',
                        'title' => 'Inactive users'
                    ],
                    'item 4'  => [
                        'text'  => 'Register',
                        'url'   => 'users/add',
                        'title' => 'Register new user'
                    ],
                    'item 5'  => [
                        'text'  => 'Trash',
                        'url'   => 'users/trash',
                        'title' => 'Thrased users'
                    ],
                    'item 6'  => [
                        'text'  => 'Setup',
                        'url'   => 'users/setup',
                        'title' => 'Reset database'
                    ],
                ],
            ],
        ], */
        
        // This is a menu item
        'about'  => [
            'text'  => '<i class="fa fa-info"></i> About',
            'url'   => $this->di->get('url')->create('about'),
            'title' => 'About'
        ],

          /*'source' => [
            'text'  =>'Källkod',
            'url'   => $this->di->get('url')->create('source'),
            'title' => 'source'
        ],*/
    
        
    ],
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getRoute()) {
                return true;
        }
    },

    // Callback to create the urls
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
];
