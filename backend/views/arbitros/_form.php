<?php

use common\models\NucleArbitros;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Arbitros */
/* @var $form yii\widgets\ActiveForm */

$modelNucleoArbitros = NucleArbitros::find()->all();
$arrayNucleoArbitros = ArrayHelper::map($modelNucleoArbitros, 'id', 'nombre');
?>

<div class="arbitros-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal'
    ]); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_nucleo_arbitro')->dropDownList($arrayNucleoArbitros,['prompt'=>'Seleccione...'])->label('Nucleo Arbitros') ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calificacion_promedio')->textInput(['type' => 'number'])->label('Calificación Pormedio') ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput(['type' => 'date'])->label('Fecha Nacimiento') ?>

    <?= $form->field($model, 'cedula')->textInput(['type' => 'number'])->label('Cédula') ?>

    <?= $form->field($model, 'hijos')->textInput(['type' => 'number']) ?>
    <div class="form-check form-switch">
        <?= $form->field($model, 'estado')->checkbox() ?>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>