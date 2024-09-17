<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
            'defaultTimeZone' => 'America/Guayaquil',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
        'user' => [
            //'class' => 'mdm\admin\models\User',
            //'identityClass' => 'mdm\admin\models\User',
            //'loginUrl' => ['admin/user/login'],
            //'identityClass' => '/site/login',
            //'loginUrl' => ['/site/login'],
        ]
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@common/messages',
                'forceTranslation' => true
            ],
            //'bsVersion' => '3'
        ],
        'gridviewKrajee' => [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ],
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
    ],



];
