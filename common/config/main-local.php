<?php

return [
    'components' => [ 
 
        'db' => [
            'class' => \yii\db\Connection::class,
            //'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'dsn' => 'pgsql:host=localhost;dbname=LigasZ',           
            'username' => 'postgres',
            'password' => '12345',
            // 'dsn' => 'pgsql:host=51.222.75.105;port=5432;dbname=yiidb',
            // 'username' => 'yii',
            // 'password' => 'yii',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.gmail.com',
                // 'username' => '1goware@gogalapagos.com',
                // 'password' => '1Gow42kd*tUb',
                'username' => 'testproyectos360@gmail.com',
                'password' => '226610Sc2017',
                'port' => '587',
            ],
            'useFileTransport' => false,
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/administrator',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
