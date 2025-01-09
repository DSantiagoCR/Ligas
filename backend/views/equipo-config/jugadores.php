<?php
//use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\Catalogos;
use common\models\Jugador;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;

$modelsEstadoCivil = Catalogos::find()->where(['id_catalogo' => 10])->all();
$arrayEstadoCivil = ArrayHelper::map($modelsEstadoCivil, 'id', 'valor');
$model  = new Jugador();

?>

<div class="card" style="padding: 10px;">
    <h3 style="color:red">Crear Jugador </h2>
        <p style="color:black"><b>Equipo: <?= $modelEquipo->nombre ?></b></p>
        <p style="color:red"><b>Campeonato: <?= $modelCampeonato->nombre . "($modelCampeonato->anio)" ?></b></p>


        <div class="jugador-form">

            <?php $form = ActiveForm::begin(
                [
                    'layout' => 'horizontal',
                    'action' => 'create-jugador'
                ]
            ); ?>

            <label for="ddl_genero" class="form-label text-primary">
                Seleccione Categoria - Genero
            </label>
            <?= Html::dropDownList(
                'ddl_genero', // Nombre del campo
                null, // Valor seleccionado por defecto (null para ninguno)
                ArrayHelper::map($modelEquipoCategoria, 'id', function ($item) {
                    return $item->categoria->valor . ' - ' . $item->genero->valor;
                }),
                [
                    'prompt' => 'Seleccione Opción',
                    'class' => 'form-select form-select-sm',
                    'id' => 'ddl_genero',
                ]
            ) ?>

            <br>
            <!-- <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?> -->

            <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fecha_nacimiento')->textInput(['type' => 'date']) ?>

            <?= $form->field($model, 'cedula')->textInput(['type' => 'number']) ?>

            <?= $form->field($model, 'celular')->textInput(['type' => 'number']) ?>

            <?= $form->field($model, 'id_estado_civil')->dropDownList($arrayEstadoCivil)->label('Estado Cívil') ?>

            <?= $form->field($model, 'hijos')->textInput(['type' => 'number']) ?>

            <?= $form->field($model, 'estado')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>