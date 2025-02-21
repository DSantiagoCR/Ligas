<?php

use common\models\Arbitros;
use common\models\Equipo;
use common\models\NucleArbitros;
use common\models\Util\HelperGeneral;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;
use kartik\editors\Summernote;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\CabeceraVocalia */
/* @var $form yii\widgets\ActiveForm */

$modelEquipos = Equipo::find()
    ->where(['id_genero' => $model->equipo1->id_genero, 'id_categoria' => $model->equipo1->id_categoria, 'id_campeonato' => $model->equipo1->id_campeonato])
    ->andWhere(['not in','id',[$model->id_equipo_1,$model->id_equipo_2]])
    ->all();
$arrayEquipos = ArrayHelper::map($modelEquipos, 'id', 'nombre');

$modelNucleoArbitro = NucleArbitros::find()->where(['estado' => true])->one();
$modelArbitros = Arbitros::find()->where(['estado' => true, 'id_nucleo_arbitro' => $modelNucleoArbitro->id])->all();
$arrayArbitro = ArrayHelper::map($modelArbitros, 'id', function ($data) {
    return $data->nombre . ' - ' . $data->apellido;
});

$arrayEstadoVocalia = HelperGeneral::devuelveEstadoVocalia();
?>

<div class="cabecera-vocalia-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'id_campeonato')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_estado_vocalia')->dropDownList($arrayEstadoVocalia,['value' => $model->estadoVocalia->valor]) ?>

    <span style="color:blue"><b>EQUIPOS</b></span>
    <hr>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'id_equipo_1')->textInput(['value' => $model->equipo1->nombre, 'disabled' => true]) ?>

            <?= $form->field($model, 'ta_e1')->textInput()->label('T.A') ?>

            <?= $form->field($model, 'tr_e1')->textInput()->label('T.R') ?>

            <?= $form->field($model, 'novedades_equipo_1')->textarea(['raw' => '3'])->label('Novedades') ?>


        </div>
        <div class="col">
            <?= $form->field($model, 'id_equipo_2')->textInput(['value' => $model->equipo2->nombre, 'disabled' => true]) ?>

            <?= $form->field($model, 'ta_e2')->textInput()->label('T.A') ?>

            <?= $form->field($model, 'tr_e2')->textInput()->label('T.R') ?>

            <?= $form->field($model, 'novedades_equipo_2')->textarea(['raw' => '3'])->label('Novedades') ?>

        </div>
    </div>
    <hr>
    <span style="color:blue"><b>INFORMES</b></span>
    <hr>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'informe_vocal')->textarea(['raw' => '3']) ?>

        </div>
        <div class="col">
            <?= $form->field($model, 'informe_veedor')->textarea(['raw' => '3']) ?>

        </div>

    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'id_arbitro')->dropDownList($arrayArbitro, ['prompt' => 'Seleccione...']) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'informe_arbitro')->textarea(['raw' => '3']) ?>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'hora_empieza')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'hora_termina')->textInput(['disabled' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'id_equipo_vocal')->dropDownList($arrayEquipos, ['prompt' => 'Seleccione...'])->label('Vocal') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'id_equipo_veedor')->dropDownList($arrayEquipos, ['prompt' => 'Seleccione...'])->label('Veedor')  ?>
        </div>
    </div>

    <?= $form->field($model, 'novedades_generales')->textarea(['raw' => '3'])->label('Obs. Generales') ?>

    <?= $form->field($model, 'novedades_directiva')->textarea(['raw' => '3'])->label('Obs. Directivas') ?>

    <?= $form->field($model, 'link_documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_cab_fecha')->hiddenInput()->label(false) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>