<?php

return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
            'baseUrl' => '/administrator',
            'csrfParam' => '_csrf-backend',
            'enableCsrfValidation' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'baseUrl' => '/administrator',
            'rules' => [
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
    ],
];
