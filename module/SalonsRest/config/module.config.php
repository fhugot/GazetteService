<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'SalonsRest\Controller\SalonsRest' => 'SalonsRest\Controller\SalonsRestController',
            'SalonsRest\Controller\SalonsFromDeptRest' => 'SalonsRest\Controller\SalonsFromDeptRestController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'salons-rest' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/salons-rest[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'SalonsRest\Controller\SalonsRest',
                    ),
                ),
            ),
            'salons-rest-dept' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/salons-rest-dept[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'SalonsRest\Controller\SalonsFromDeptRest',
                    ),
                ),
            ),            
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
  
);