<?php

use PeachUserPanel\Controller;
use PeachUserPanel\Service;

return [
    'router' => [
        'routes' => [
            'PeachUserPanel' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/peach/admin/user-panel',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'edit' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/edit[-:id].html',
                            'constraints' => [
                                'action' => '[a-zA-Z]+',
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => Controller\EditController::class,
                                'action' => 'index'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\IndexFactory::class,
            Controller\EditController::class => Controller\EditFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\UserPanel::class => Service\UserPanelFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];