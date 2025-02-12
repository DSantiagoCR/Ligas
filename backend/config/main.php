<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'Ligas',
    'timeZone' => 'America/Guayaquil',
    'language' => 'es',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'mainLayout' => '@app/views/layouts/main.php',
            'menus' => [
                'rule' => null, // disable menu
                'assignment' => null,
                'menu' => null
            ],
        ],
        'general' => [
            'class' => 'backend\modules\general\Module',
        ],
    ],
    'components' => [

        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'authTimeout' => 480,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                    'bsVersion'=>'4.x',
                ],
                'dmstr\web\AdminLteAsset' => [
                    'css' => [],
                ],

            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'imageUploader' => [
            'class' => 'yii\helpers\BaseFileHelper',
            'basePath' => '@webroot/uploads', // Ruta absoluta a la carpeta de destino
            'baseUrl' => '@web/uploads', // URL base de la carpeta de destino
        ],
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'actions' => ['login', 'error', 'request-password-reset', 'reset-password', 'logout','verify-email'],
                'allow' => true,
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
//            'gii/*',
//            'admin/*',
            'gridview/*',
            'site/reset-password',
            'site/request-password-reset',
            'site/email',
            'site/verify-email',
            'site/logout',
            'site/login',
            'site/index',
        ]
    ],
    'params' => $params,
    'defaultRoute'=>'site/index',
];
