<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/body_login.css');
?>
<div class="site-reset-password">
    <div class="body-content" align="center">
        <img class="img-responsive hidden-xs" src="<?= Yii::getAlias('@web') ?>/img/logo-34-anos-vertical.png" alt="logo"/>
    </div>
    <div class="card-lg-5 p-3" style="" align="center">
    <h1 style="color:white;"><?= Html::encode($this->title) ?></h1>

    <p style="color:white;">Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('Password',['style'=>'color:white;']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'form-control btn btn-outline-light submit px-3']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
</div>
