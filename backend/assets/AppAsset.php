<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        //'backend\assets\AngularAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public function init() {
        parent::init();
//        if (Yii::$app->controller->module->id == 'booking') {
//            \backend\modules\booking\assets\BookingAsset::register(Yii::$app->view);
//        }
    }
}
