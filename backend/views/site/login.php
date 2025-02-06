<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->registerCssFile('@web/css/body_login2.css');
?>
<div class="" align="center">
<div class="login-box" style="width: 25rem;" align="center">
    <div class="body-content p-5" align="center">
        <img class="img-responsive hidden-xs" src="<?= Yii::getAlias('@web') ?>/img/balontierra.png" alt="logo" width="250px" style="border-radius: 50%;"/>
    </div>

    <div class="login-box-body">
        <br>
        <p class="h6" align="center" style="color: white;">Inicio de Sesión</p>

        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form','class'=>'signin-form']) ?>
        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append" >',//<span class="input-group-text" >@example.com</span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => '<div class="custom-control-input">{input}{label}</div>',
                    'labelOptions' => [
                        'class' => 'checkbox-wrap'
                    ],
                    'uncheck' => null
                ]) ?>
            </div>
            <div class="col-4 form-group">
                <?= Html::submitButton('Log In', ['class' => 'form-control btn btn-outline-light submit px-3']) ?>
            </div>
        </div>
        <br>
        <?php \yii\bootstrap4\ActiveForm::end(); ?>
<!--        <div  class="social d-flex text-center">-->
<!--            <button type="button" class="px-2 py-2 mr-md-1 rounded">-->
<!--                <a href="forgot-password.html" style="color: black;text-decoration:none;">Olvide mi contrase</a>-->
<!--            </button>-->
<!--            <button type="button" class="px-2 py-2 mr-md-1 rounded">-->
<!--                <a href="register.html" style="color: black;text-decoration:none">Registrarse</a>-->
<!--            </button>-->
<!--        </div>-->
        <div class="my-1 mx-0" style="color:#999;">
            <scan style="color:aliceblue"><b>Si olvido su contraseña, puede restablecerla</b></scan>  
            <br>
            <?= Html::a('Click Aquí', ['site/request-password-reset']) ?>.
            <br>
           <!-- Need new verification email?<?php //= Html::a('Resend', ['site/resend-verification-email']) ?> -->
        </div>

        <?php
        //div que devuelme el mensaje del envio del correo
        if (Yii::$app->session->getFlash('success')!=null):
        ?>
            <div id="w3-success-0" class="alert-success alert alert-dismissible" role="alert">
                <?= Yii::$app->session->getFlash('success');?>
            </div>
        <?php
        endif;
        ?>
    </div>
</div>
</div>
