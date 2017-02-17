<?php

namespace Participant;

use Participant\Controller\ParticipantControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'participant' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/participant',
                    'defaults' => [
                        'controller' => Controller\ParticipantController::class,
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
                                'controller' => Controller\ParticipantController::class,
                                'action'    =>  'list'
                            )
                        )
                    ),
                    'generate-bib-numbers'   =>  array(
                        'type'    => Literal::class,
                        'options'   =>  array(
                            'route' =>  '/generate-bib-numbers',
                            'defaults'  =>  array(
                                'controller' => Controller\ParticipantController::class,
                                'action'    =>  'generate-bib-numbers'
                            )
                        )
                    ),
                    'participant-form'   =>  array(
                        'type'    => Segment::class,
                        'options'   =>  array(
                            'route' =>  '/participant-form[/:id]',
                            'defaults'  =>  array(
                                'controller' => Controller\ParticipantController::class,
                                'action'    =>  'participant-form'
                            )
                        )
                    ),
                    'delete'   =>  array(
                        'type'    => Segment::class,
                        'options'   =>  array(
                            'route' =>  '/delete[/:id]',
                            'defaults'  =>  array(
                                'controller' => Controller\ParticipantController::class,
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
            Controller\ParticipantController::class => ParticipantControllerFactory::class
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
