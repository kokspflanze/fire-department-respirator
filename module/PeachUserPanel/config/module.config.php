<?php

use PeachUserPanel\Controller;
use PeachUserPanel\Service;
use PeachUserPanel\Form;

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
                    'detail' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/edit[-:id].html',
                            'constraints' => [
                                'action' => '[a-zA-Z]+',
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => Controller\DetailController::class,
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
            Controller\DetailController::class => Controller\DetailFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\UserPanel::class => Service\UserPanelFactory::class,
            Form\User::class => Form\UserFactory::class
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