<?php

use common\models\Campeonato;
use common\models\Equipo;
use common\models\Util\HelperGeneral;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Directivos */
/* @var $form yii\widgets\ActiveForm */
$modelCampeonato = HelperGeneral::devuelveCampeonatoActual();

$arrayEstadoCivil =  HelperGeneral::devuelveArrayEstadoCivil();

$arrayTipoDirectivo = HelperGeneral::devuelveTipoDirectivo();

$arrayEquipo = HelperGeneral::devuelveEquiposCampeonatoActual();


$modelCampeonato = Campeonato::find()->where(['estado'=>1])->all();
$arrayCampeonato = ArrayHelper::map($modelCampeonato,'id','nombre');

?>

<div class="directivos-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <!-- <?= $form->field($model, 'code', ['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'nombre', ['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido', ['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento', ['errorOptions' => ['class' => 'text-danger']])->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'cedula', ['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true])->label('Cédula') ?>

    <?= $form->field($model, 'id_estado_civil', ['errorOptions' => ['class' => 'text-danger']])->dropDownList($arrayEstadoCivil, ['prompt' => 'Seleccione'])->label('Estado Civíl') ?>
    
    <?= $form->field($model, 'id_equipo', ['errorOptions' => ['class' => 'text-danger']])->dropDownList($arrayEquipo, ['prompt' => 'Seleccione'])->label('Equipo') ?>
    
    <?= $form->field($model, 'id_tipo_directivo', ['errorOptions' => ['class' => 'text-danger']])->dropDownList($arrayTipoDirectivo, ['prompt' => 'Seleccione'])->label('Tipo Directivo') ?>
    
    <?= $form->field($model, 'id_campeonato', ['errorOptions' => ['class' => 'text-danger']])->dropDownList($arrayCampeonato, ['prompt' => 'Seleccione'])->label('Campeonato') ?>
    
    <div class="form-check form-switch">
        <?= $form->field($model, 'estado', ['errorOptions' => ['class' => 'text-danger']])->checkbox(['label' => 'Activado'])->label('Estado') ?>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>