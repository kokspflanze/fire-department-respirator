<?php

use PeachUserPanel\Controller;
use PeachUserPanel\Service;
use PeachUserPanel\Form;
use PeachUserPanel\View;
use Zend\ServiceManager\Factory\InvokableFactory;

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
                            'route' => '/detail[/:action][-:id].html',
                            'constraints' => [
                                'action' => '[a-zA-Z-]+',
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => Controller\DetailController::class,
                                'action' => 'index'
                            ],
                        ],
                    ],
                    'role' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/role[/:action][-:id][/:roleId].html',
                            'constraints' => [
                                'action' => '[a-zA-Z]+',
                                'id' => '[0-9]+',
                                'roleId' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\RoleController::class,
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
            Controller\RoleController::class => Controller\RoleFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\UserPanel::class => Service\UserPanelFactory::class,
            Service\RoleService::class => Service\RoleFactory::class,
            Form\User::class => Form\UserFactory::class,
            Form\UserRole::class => Form\UserRoleFactory::class,
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'pserverformerrors' => View\Helper\FormError::class,
            'formWidget' => View\Helper\FormWidget::class,
        ],
        'factories' => [
            View\Helper\FormError::class => InvokableFactory::class,
            View\Helper\FormWidget::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'peach-cms-user-panel/index/new' => __DIR__ . '/../view/peach-user-panel/index/index.phtml',
            'helper/formWidget' => __DIR__ . '/../view/helper/form.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];