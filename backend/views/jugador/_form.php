<?php

use common\models\Campeonato;
use common\models\Equipo;
use common\models\Util\HelperGeneral;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
/* @var $form yii\widgets\ActiveForm */


$arrayEstadoCivil = HelperGeneral::devuelveArrayEstadoCivil();

$modelCampeonato = Campeonato::find()->where(['estado' => true])->one();
// $modelEquipos = Equipo::find()->where(['id_campeonato' => $modelCampeonato->id])->all();
// $arrayEsquipos = ArrayHelper::map($modelEquipos, 'id', 'nombre');

$modelEquipos = Equipo::find()->where(['activo'=>true,'id_campeonato' => $modelCampeonato->id])->all();
$arrayEquipos = ArrayHelper::map($modelEquipos, 'id', function($model) {  
    return $model->nombre . ' - ' . $model->categoria->valor . ' - '. $model->genero->valor;
});
?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <!-- <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'id_campeonato')->hiddenInput(['value' => $modelCampeonato->id])->label(false) ?> 

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_camiseta')->textInput(['type' => 'number'])->label('Número') ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'cedula')->textInput(['type' => 'number'])->label('Cédula') ?>

    <?= $form->field($model, 'celular')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'id_estado_civil')->dropDownList($arrayEstadoCivil,['prompt'=>'Seleccione..'])->label('Estado Cívil') ?>

    <?= $form->field($model, 'id_equipo')->dropDownList($arrayEquipos,['prompt'=>'Seleccione..'])->label('Equipo') ?>

    <?= $form->field($model, 'hijos')->textInput(['type' => 'number']) ?>
    <div class="form-check form-switch">
        <?= $form->field($model, 'estado')->checkbox(['label' => 'Calificado']) ?>
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