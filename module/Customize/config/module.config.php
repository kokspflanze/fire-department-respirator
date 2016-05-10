<?php

use Customize\Controller;
use Customize\Service;
use Customize\View\Helper;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'small-user-auth' => [
            'options' => [
                'route' => '/auth[/:action][/:code].html',
            ],
        ],
        'routes' => [
            'Respirator' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'home' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => 'home.html',
                            'constraints' => [
                                'action' => '[a-zA-Z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\HomeController::class,
                                'action' => 'index'
                            ],
                        ],
                    ],
                    'reminder-user' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => 'reminder-user.html',
                            'constraints' => [
                                'action' => '[a-zA-Z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ReminderUserController::class,
                                'action' => 'index'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'active' => Helper\Active::class,
        ],
        'factories' => [
            Helper\Active::class => Helper\ActiveFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\HomeController::class => InvokableFactory::class,
            Controller\ReminderUserController::class => Controller\ReminderUserFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\ReminderUser::class => Service\ReminderUserFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => false,
        'display_exceptions' => false,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'small-user' => [
        'login' => [
            'route' => 'Respirator/home',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'application_entities' => [
                'paths' => [__DIR__ . '/../src/Customize/Entity']
            ],
        ],
    ],
];