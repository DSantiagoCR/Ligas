<?php

return [
    'components' => [
        // 'db' => [
        //     'class' => \yii\db\Connection::class,
        //     'dsn' => 'mysql:host=10.100.1.133;dbname=goxweb_booking231',
        //     'username' => 'desarrollo',
        //     'password' => 'desarrollo',
        //     'charset' => 'utf8',
        // ],
        //    'db' => [
        //        'class' => \yii\db\Connection::class,
        //        'dsn' => 'mysql:host=localhost;dbname=goxweb_booking231',
        //        'username' => 'root',
        //        'password' => '',
        //        'charset' => 'utf8',
        //    ],
        'db' => [
            'class' => \yii\db\Connection::class,
            //'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            //'dsn' => 'pgsql:host=localhost;dbname=Ligas',
            'dsn' => 'pgsql:host=181.188.210.115;port=11045;dbname=devos',
            'username' => 'devos',
            'password' => 'devos',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.gmail.com',
                'username' => '1goware@gogalapagos.com',
                'password' => '1Gow42kd*tUb',
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
