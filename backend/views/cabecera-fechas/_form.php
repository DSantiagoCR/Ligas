<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;
use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use common\models\Campeonato;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\CabeceraFechas */
/* @var $form yii\widgets\ActiveForm */



$modelDiasSemana = Catalogos::find()->where(['id_catalogo' => 31, 'estado' => true])->all();
$arrayDiasSemana = ArrayHelper::map($modelDiasSemana, 'valor', 'valor');


$modelEstadoFechasCalendario = Catalogos::find()->where(['id_catalogo' => 43, 'estado' => true])->all();
$arrayEstadoFechasCalendario = ArrayHelper::map($modelEstadoFechasCalendario, 'id', 'valor');

$keys = array_keys($arrayEstadoFechasCalendario);

$modelsCampeonato = Campeonato::find()->where(['estado' => true])->one();
$modelsCampeonatoALL = Campeonato::find()->where(['estado' => true])->all();
$arrayCampeonato = ArrayHelper::map($modelsCampeonatoALL, 'id', 'nombre');


?>

<div class="cabecera-fechas-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'num_fecha')->textInput()->label('Num. Fecha') ?>

    <?= $form->field($model, 'fecha')->textInput(['type' => 'date', 'id' => 'txt_date']) ?>

    <?= $form->field($model, 'dia')->textInput(['id' => 'txt_dia_semana', 'readonly' => true]) ?>

    <?= $form->field($model, 'id_campeonato')->dropDownList($arrayCampeonato, [
        'options' => [
            $modelsCampeonato->id => ['Selected' => true]
        ]
    ])->label('Campeonato') ?>

    <?php
    if ($model->isNewRecord) {
        
    ?>
        <?= $form->field($model, 'id_estado_fecha')->dropDownList($arrayEstadoFechasCalendario,['prompt'=>'Seleccione'])->label('Estado Fecha') ?>
        <div class="form-check form-switch">
            <?= $form->field($model, 'estado')->checkbox(['label' => 'Activado', 'checked' => true]) ?>
        </div>
    <?php
    } else {
    ?>
        <?= $form->field($model, 'id_estado_fecha')->dropDownList($arrayEstadoFechasCalendario, ['prompt' => 'Seleccione...'])->label('Estado Fecha') ?>
        <div class="form-check form-switch">
            <?= $form->field($model, 'estado')->checkbox(['label' => 'Activado']) ?>
        </div>
    <?php
    }
    ?>



    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
<?php

$this->registerJs("
            $('#txt_date').change(function() {
                var fecha = $(this).val();
                $.ajax({
                    type:'POST',
                    url: '" . Url::to(['retornar-dia-semana']) . "',
                    data: {fecha: fecha},
                    dataType: 'json',
                    success: function(data) {
                         if (data.valor) {
                                $('#txt_dia_semana').val(data.valor);
                            } else {
                                alert('Error al procesar la fecha');
                            }                   
                    },
                     error: function() {
                        alert('Error de comunicación con el servidor.');
                    }
                });
            });
    ");
?>