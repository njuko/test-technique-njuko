<?php

namespace User;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'user' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/user',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => array(
                    'list'   =>  array(
                        'type'    => Segment::class,
                        'options'   =>  array(
                            'route' =>  '/list[/:parameters]',
                            'defaults'  =>  array(
                                'controller' => Controller\UserController::class,
                                'action'    =>  'list'
                            )
                        )
                    ),
                    'generate-bib-numbers'   =>  array(
                        'type'    => Literal::class,
                        'options'   =>  array(
                            'route' =>  '/generate-bib-numbers',
                            'defaults'  =>  array(
                                'controller' => Controller\UserController::class,
                                'action'    =>  'generate-bib-numbers'
                            )
                        )
                    ),
                    'user-form'   =>  array(
                        'type'    => Segment::class,
                        'options'   =>  array(
                            'route' =>  '/user-form[/:id]',
                            'defaults'  =>  array(
                                'controller' => Controller\UserController::class,
                                'action'    =>  'user-form'
                            )
                        )
                    ),
                    'delete'   =>  array(
                        'type'    => Segment::class,
                        'options'   =>  array(
                            'route' =>  '/delete[/:id]',
                            'defaults'  =>  array(
                                'controller' => Controller\UserController::class,
                                'action'    =>  'delete'
                            )
                        )
                    ),
                ),
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\UserController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../../Application/view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../../Application/view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../../Application/view/error/404.phtml',
            'error/index'             => __DIR__ . '/../../Application/view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]
];
