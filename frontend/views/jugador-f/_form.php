<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;

use common\models\Util\HelperGeneral;
/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
/* @var $form yii\widgets\ActiveForm */

$arrayEstadoCivil = HelperGeneral::devuelveArrayEstadoCivil();


?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'id_equipo')->textInput(['value'=>$model->equipo->nombre,'disabled'=>true])->label('Equipo') ?>


    <?= $form->field($model, 'code')->hiddenInput(['value' => '-'])->label(false) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_camiseta')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'cedula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_estado_civil')->dropDownList($arrayEstadoCivil, ['prompt' => 'Seleccione..'])->label('Estado Cívil') ?>

    <?= $form->field($model, 'hijos')->textInput() ?>
    <div class="form-check form-switch">
        <?= $form->field($model, 'estado')->checkbox(['disabled' => true]) ?>
    </div>

  
    <div class="form-check form-switch">
        <?= $form->field($model, 'puede_jugar')->checkbox() ?>
    </div>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>