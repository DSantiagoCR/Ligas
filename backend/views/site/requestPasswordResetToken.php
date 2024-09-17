<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/body_login.css');
?>
<div class="site-request-password-reset">
    <div class="body-content" align="center">
        <img class="img-responsive hidden-xs" src="<?= Yii::getAlias('@web') ?>/img/logo-34-anos-vertical.png" alt="logo"/>
    </div>
    <div class="card-lg-5 p-3" style="" align="center">
        <div class="card-header">
            <h1 style="color:white;"><?= Html::encode($this->title) ?></h1>
            <p style="color:white;">Please fill out your email. A link to reset password will be sent there.</p>
        </div>
        <div class="card-body">
            <div class="row" >
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Email',['style'=>'color:white;']) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Send', ['class' => 'form-control btn btn-outline-light submit px-3']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
