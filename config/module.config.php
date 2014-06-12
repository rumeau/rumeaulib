<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'ModelManager' => 'RumeauLib\Model\Service\ModelManagerFactory',
        ),
        'aliases'   => array(
            'RumeauLib\EntityManager\Default' => 'doctrine.entitymanager.orm_default',
        ),
    ),
    'validators'      => array(
        'invokables' => array(
            'rut' => 'RumeauLib\Validator\Rut',
        ),
    ),
    'view_helpers'    => array(
        'invokables' => array(
            'prettyName' => 'RumeauLib\View\Helper\PrettyName',
            'pageTitle'  => 'RumeauLib\View\Helper\PageTitle',
        ),
    ),
);
