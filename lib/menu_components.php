<?php
/**
 * Created by PhpStorm.
 * User: JeffVandenberg
 * Date: 12/31/2017
 * Time: 1:07 AM
 */
$menu = [
    'base' => [
        'Home' => [
            'link' => '/',
            'target' => '_top'
        ],
        'Forum' => [
            'link' => '/forum'
        ],
        'Our World' => [
            'menu' => [
                'Introduction' => '/wiki/OurWorld/OurWorld',
                'City Aspects' => '/wiki/OurWorld/SettingAspects',
                'The Cast (PCs)' => [
                    'link' => [
                        'controller' => 'characters',
                        'action' => 'cast'
                    ]
                ],
                'NPCs' => '/wiki/OurWorld/NPCs',
                'Locations' => '/wiki/OurWorld/Locations',
                'Factions' => '/wiki/OurWorld/Factions',
                'City Map' => [
                    'link' => 'https://www.google.com/maps/d/viewer?mid=1VdMk5bLda0YRxF5DHh7DyUugWgvIx_Ov&ll=29.966120919084982%2C-90.06174234865722&z=13',
                    'target' => '_blank'
                ]
            ]
        ],
        'Game Guide' => [
            'menu' => [
                'About Dominium Fuego' => '/wiki/GameGuide/GameGuide',
                'New Player Guide' => '/wiki/GameGuide/NewPlayerGuide',
                'Game Configuration' => '/wiki/HouseRules/GameConfiguration',
                'Character Creation' => '/wiki/HouseRules/CharacterCreation',
                'Magic Rules' => '/wiki/MagicRules/MagicRules',
            ]
        ],
        'Database' => [
            'menu' => [
                'Powers' => [
                    'link' => [
                        'controller' => 'powers',
                        'action' => 'index'
                    ]
                ],
                'Skills' => [
                    'link' => [
                        'controller' => 'skills',
                        'action' => 'index'
                    ]
                ],
                'Stunts' => [
                    'link' => [
                        'controller' => 'stunts',
                        'action' => 'index'
                    ]
                ],
                'Templates' => [
                    'link' => [
                        'controller' => 'templates',
                        'action' => 'index'
                    ]
                ]
            ]
        ],
        'Tools' => [
            'menu' => [
                'Calendar' => [
                    'link' => 'https://calendar.google.com/calendar/embed?src=ragnaroknycgmstaff%40gmail.com',
                    'target' => '_blank'
                ]
            ]
        ],
    ],
    'player' => [
        'Tools' => [
            'menu' => [
                'Your Characters' => [
                    'link' => [
                        'controller' => 'characters',
                        'action' => 'index'
                    ]
                ],
                'Scene Roller' => [
                    'link' => [
                        'controller' => 'diceRolls',
                        'action' => 'scene'
                    ]
                ]
            ]
        ]
    ],
    'EditUsers' => [
        'Tools' => [
            'menu' => [
                'User Management' => [
                    'link' => [
                        'controller' => 'users',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'GameMaster' => [
        'Tools' => [
            'menu' => [
                'GM Tools' => [
                    'link' => [
                        'controller' => 'gamemaster',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'Admin' => [
        'Tools' => [
            'menu' => [
                'Game Configuration' => [
                    'link' => [
                        'controller' => 'configurations',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ]
];

return $menu;
