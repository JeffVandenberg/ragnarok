<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/26/13
 * Time: 10:37 AM
 * To change this template use File | Settings | File Templates.
 */

App::uses('Component', 'Controller');

/**
 * @property AuthComponent Auth
 * @property RagnarokPermissionsComponent RagnarokPermissions
 * @property SessionComponent Session
 */
class MenuComponent extends Component
{
    public $components = array(
        'Auth',
        'RagnarokPermissions',
        'Session'
    );

    private $menu = array();

    public function InitializeMenu()
    {
        $this->menu = [
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
                        'link' => 'https://drive.google.com/open?id=19lT_rlqzNv6iNIMqBhA1xNPMUlk&usp=sharing',
                        'target' => '_blank'
                    ]
                ]
            ],
            'Game Guide' => [
                'menu' => [
                    'About Dominium Fuego' => '/wiki/GameGuide/GameGuide',
                    'New Player Guide' => '/wiki/GameGuide/NewPlayerGuide',
                    'Game Configuration' => '/wiki/GameGuide/GameConfiguration',
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

        ];

        if ($this->Auth->user()) {
            $this->menu['Tools']['menu']['Your Characters'] = [
                'link' => [
                    'controller' => 'characters',
                    'action' => 'index'
                ]
            ];
            $this->menu['Tools']['menu']['Scene Roller'] = [
                'link' => [
                    'controller' => 'diceRolls',
                    'action' => 'scene'
                ]
            ];
        }

        if ($this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$ViewUsers)) {
            $this->menu['Tools']['menu']['User management'] = [
                'link' => [
                    'controller' => 'users',
                    'action' => 'index'
                ]
            ];
        }

        if ($this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$GameMaster)) {
            $this->menu['Tools']['menu']['GM Tools'] = [
                'link' => [
                    'controller' => 'gamemaster',
                    'action' => 'index'
                ]
            ];
        }

        if ($this->RagnarokPermissions->CheckPermission($this->Auth->user('user_id'), Permission::$Admin)) {
            $this->menu['Tools']['menu']['Game Configuration'] = [
                'link' => [
                    'controller' => 'configuration',
                    'action' => 'index'
                ]
            ];
        }
    }

    public function GetMenu()
    {
        return $this->menu;
    }
}
