<?php
return [
    'bjyauthorize' => [

        // set the 'guest' role as default (must be defined in a role provider]
        'default_role' => 'guest',

        /* this module uses a meta-role that inherits from any roles that should
         * be applied to the active user. the identity provider tells us which
         * roles the "identity role" should inherit from.
         *
         * for ZfcUser, this will be your default identity provider
         */
        'identity_provider' => \BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider::class,

        /* If you only have a default role and an authenticated role, you can
         * use the 'AuthenticationIdentityProvider' to allow/restrict access
         * with the guards based on the state 'logged in' and 'not logged in'.
         *
         * 'default_role'       => 'guest',         // not authenticated
         * 'authenticated_role' => 'user',          // authenticated
         * 'identity_provider'  => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
         */

        /* role providers simply provide a list of roles that should be inserted
         * into the Zend\Acl instance. the module comes with two providers, one
         * to specify roles in a config file and one to load roles using a
         * Zend\Db adapter.
         */
        'role_providers' => [
            // this will load roles from
            // the 'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' service
            \BjyAuthorize\Provider\Role\ObjectRepositoryProvider::class => [
                // class name of the entity representing the role
                'role_entity_class' => \SmallUser\Entity\UserRole::class,
                // service name of the object manager
                'object_manager' => 'doctrine.entitymanager.orm_default',
            ],
        ],

        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => [
            \BjyAuthorize\Provider\Resource\Config::class => [
                'Respirator' => [],
                'Respirator/home' => [],
                'PeachUserPanel' => [],
                'PeachUserPanel/detail' => [],
                'PeachUserPanel/role' => [],
                'small-user-auth' => [],
            ],
        ],


        /* rules can be specified here with the format:
         * [roles (array], resource, [privilege (array|string], assertion]]
         * assertions will be loaded using the service manager and must implement
         * Zend\Acl\Assertion\AssertionInterface.
         * *if you use assertions, define them using the service manager!*
         */
        'rule_providers' => [
            \BjyAuthorize\Provider\Rule\Config::class => [
                'allow' => [
                    // allow guests and users (and admins, through inheritance]
                    // the "wear" privilege on the resource "pants"
                    ['guest', 'small-user-auth', 'index'],
                    [[], 'small-user-auth', 'logout'],
                    [[], 'Respirator'],
                    [['user'], 'Respirator/home'],
                    [['user'], 'PeachUserPanel'],
                    [['admin'], 'PeachUserPanel/detail'],
                    [['admin'], 'PeachUserPanel/role'],
                ],

                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => [
                    ['guest', 'small-user-auth', 'logout'],
                ],
            ],
        ],


        /* Currently, only controller and route guards exist
         *
         * Consider enabling either the controller or the route guard depending on your needs.
         */
        'guards' => [
            /* If this guard is specified here (i.e. it is enabled], it will block
             * access to all controllers and actions unless they are specified here.
             * You may omit the 'action' index to allow access to the entire controller
             */
            \BjyAuthorize\Guard\Controller::class => [
                /*['controller' => 'index', 'roles' => ['guest']],
                ['controller' => 'site', 'roles' => ['guest']],
                // You can also specify an array of actions or an array of controllers (or both]
                // allow "guest" and "admin" to access actions "list" and "manage" on these "index",
                // "static" and "console" controllers
                [
                    'controller' => ['index', 'static', 'console'],
                    'action' => ['list', 'manage'],
                    'roles' => ['guest', 'admin']
                ],
                [
                    'controller' => ['search', 'administration'],
                    'roles' => ['admin']
                ],
                ['controller' => 'zfcuser', 'roles' => []],
                 */
                // Below is the default index action used by the ZendSkeletonApplication
                ['controller' => \Customize\Controller\IndexController::class, 'roles' => []],
                ['controller' => 'SmallUser\Controller\Auth', 'roles' => []],
                ['controller' => \Customize\Controller\HomeController::class, 'roles' => ['user']],
                ['controller' => \PeachUserPanel\Controller\IndexController::class, 'roles' => ['user']],
                ['controller' => \PeachUserPanel\Controller\DetailController::class, 'roles' => ['admin']],
                ['controller' => \PeachUserPanel\Controller\RoleController::class, 'roles' => ['admin']],
            ],

            /* If this guard is specified here (i.e. it is enabled], it will block
             * access to all routes unless they are specified here.
            'BjyAuthorize\Guard\Route' => [
                ['route' => 'zfcuser', 'roles' => ['user']],
                ['route' => 'zfcuser/logout', 'roles' => ['user']],
                ['route' => 'zfcuser/login', 'roles' => ['guest']],
                ['route' => 'zfcuser/register', 'roles' => ['guest']],
                // Below is the default index action used by the ZendSkeletonApplication
                ['route' => 'home', 'roles' => ['guest', 'user']],
            ],
             */
        ],
        // strategy service name for the strategy listener to be used when permission-related errors are detected
        'unauthorized_strategy' => \BjyAuthorize\View\UnauthorizedStrategy::class,

        // Template name for the unauthorized strategy
        'template' => 'error/403',

        // cache options have to be compatible with Zend\Cache\StorageFactory::factory
        'cache_options' => [
            'adapter' => [
                'name' => 'memory',
            ],
            'plugins' => [
                'serializer',
            ]
        ],

        // Key used by the cache for caching the acl
        'cache_key' => 'bjyauthorize_acl'
    ],
];