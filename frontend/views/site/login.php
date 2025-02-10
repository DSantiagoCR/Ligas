<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login p-5">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>Please fill out the following fields to login:</p> -->
    <br>
    <div class="row">
        <div class="col-lg">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="my-1 mx-0" style="color:#999;">
                <scan style="color:red">Si olvido su contraseña, puede restablecerla </scan><?= Html::a('click aqui', ['site/request-password-reset']) ?>
                <br>


                <!-- Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?> -->
            </div>
            <br>

            <!-- <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div> -->
            <div class="col-4 form-group">
                <?= Html::submitButton('Log In', ['class' => 'form-control btn btn-outline-dark submit px-3']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg">
            <div class="body-content p-5" align="center">
                <img class="img-responsive hidden-xs" src="<?= Yii::getAlias('@web') ?>/backend/web/img/balontierra.png" alt="logo" width="250px" style="border-radius: 50%;" />
            </div>
        </div>
    </div>
</div>