<?php

use common\models\Catalogos;
use common\models\GrupoEquipo;
use common\models\Util;
use common\models\Grupos;
use common\models\Util\HelperGeneral;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;
use kartik\depdrop\DepDrop;

\kartik\depdrop\DepDropAsset::register($this);


/* @var $this yii\web\View */
/* @var $model common\models\DetalleFecha */
/* @var $form yii\widgets\ActiveForm */

// $modelEtapas = Catalogos::find()->where(['id_catalogo' => 27,'estado'=>true])->all();
// $arrayEtapas = ArrayHelper::map($modelEtapas, 'id', 'valor');

$objHelper = new HelperGeneral();
$arrayGrupos = [];
if ($model->id_grupo) {
    $modelGrupo = Grupos::find()->where(['id_catalogo' => $model->grupo->id_catalogo, 'id_genero' => $model->grupo->id_genero])->all();
    $arrayGrupos = ArrayHelper::map($modelGrupo, 'id', 'nombre');
}

$arrayEquipo1 = [];
if ($model->id_grupo) {
    $modelGrupoEquipo1 = GrupoEquipo::find()->where(['id_grupo' => $model->id_grupo])->all();

    $arrayEquipo1 = ArrayHelper::map($modelGrupoEquipo1, 'id', function ($data) {
        return  $data->equipo->nombre;
    });
}
$arrayEquipo2 = [];
if ($model->id_grupo) {
    $modelGrupoEquipo2 = GrupoEquipo::find()->where(['id_grupo' => $model->id_grupo])->all();

    $arrayEquipo2 = ArrayHelper::map($modelGrupoEquipo2, 'id', function ($data) {
        return  $data->equipo->nombre;
    });
}

?>
<div class="detalle-fecha-form">

    <?php if (Yii::$app->session->hasFlash('A1')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('A1') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'id_cabecera_fecha')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_etapa')->dropDownList($objHelper->helperArrayEtapas(), ['id' => 'id_etapa1', 'prompt' => 'Seleccione...']) ?>

    <?= $form->field($model, 'id_grupo')->dropDownList(
        $arrayGrupos,
        ['id' => 'drop_grupos', 'prompt' => 'Seleccione...']
    )->label('Grupo');
    ?>

    <?= $form->field($model, 'id_grupo_equipo1')->dropDownList(
        $arrayEquipo1,
        ['id' => 'drop_equipo1', 'prompt' => 'Seleccione...']
    )->label('Equipo1') ?>

    <?= $form->field($model, 'id_grupo_equipo2')->dropDownList(
        $arrayEquipo2,
        ['id' => 'drop_equipo2', 'prompt' => 'Seleccione...']
    )->label('Equipo2') ?>


    <?= $form->field($model, 'hora_inicio')->dropDownList(
        $objHelper->helperArrayHoraPartido(),
        ['id' => 'idHoraInicio', 'type' => 'time', 'prompt' => 'Seleccione...']
    ) ?>

    <?= $form->field($model, 'id_estado_partido')->dropDownList($objHelper->helperArrayEstadoPartido(), ['prompt' => 'Seleccione..'])->label('Estado Partido') ?>
    <div class="form-check form-switch">
        <?= $form->field($model, 'estado')->checkbox()->label('Activado') ?>
    </div>
    <?= $form->field($model, 'goles_equipo1')->hiddenInput(['value' => 0])->label(false) ?>

    <?= $form->field($model, 'goles_equipo2')->hiddenInput(['value' => 0])->label(false)  ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJs("
            $('#id_etapa1').change(function() {
                var etapa_id = $(this).val();
                $.ajax({
                    type:'POST',
                    url: '" . Url::to(['busqueda-etapa-grupo']) . "',
                    data: {id_etapa1: etapa_id},
                    success: function(data) {
                        $('#drop_grupos').empty().append('<option value=\"\">Seleccione...</option>');
                        $.each(data, function(index, item) {
                            $('#drop_grupos').append('<option value=\"' + item.id + '\">' + item.name + '</option>');
                        });
                    }
                });
            });
    ");

    $this->registerJs("
            $('#drop_grupos').change(function() {
                var id_grupo = $(this).val();
                $.ajax({
                    type:'POST',
                    url: '" . Url::to(['busqueda-grupo-equipo1']) . "',
                    data: {id_grupo1: id_grupo},
                    success: function(data) {
                        $('#drop_equipo1').empty().append('<option value=\"\">Seleccione...</option>');
                        $.each(data, function(index, item) {
                            $('#drop_equipo1').append('<option value=\"' + item.id + '\">' + item.name + '</option>');
                        });
                    }
                });
            });
    ");

    $this->registerJs("
            $('#drop_equipo1').change(function() {
                var id_grupo_equipo1 = $(this).val();
                $.ajax({
                    type:'POST',
                    url: '" . Url::to(['busqueda-grupo-equipo2']) . "',
                    data: {id_grupo_equipo1: id_grupo_equipo1},
                    success: function(data) {
                        $('#drop_equipo2').empty().append('<option value=\"\">Seleccione...</option>');
                        $.each(data, function(index, item) {
                            $('#drop_equipo2').append('<option value=\"' + item.id + '\">' + item.name + '</option>');
                        });
                    }
                });
            });
    ");

    $this->registerJs("
$('#drop_equipo2').change(function() {
    var id_grupo = $('#drop_grupos').val();
    var id_cab_fechas = '" . $model->id_cabecera_fecha . "';
    $.ajax({
        type:'POST',
        url: '" . Url::to(['busqueda-horas-inicio']) . "',
        data: {
        id_grupo: id_grupo,
        id_cab_fechas:id_cab_fechas
         },
        success: function(data) {
            $('#idHoraInicio').empty().append('<option value=\"\">Seleccione...</option>');
            $.each(data, function(index, item) {
                $('#idHoraInicio').append('<option value=\"' + item.id + '\">' + item.name + '</option>');
            });
        }
    });
});
");


    ?>
</div>