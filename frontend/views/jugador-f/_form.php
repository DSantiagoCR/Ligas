<?php

use common\models\Campeonato;
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;
use common\models\Util\HelperGeneral;
/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
/* @var $form yii\widgets\ActiveForm */

$arrayEstadoCivil = HelperGeneral::devuelveArrayEstadoCivil();
$aniosJugador =  HelperGeneral::calcularEdadCompleta($model->fecha_nacimiento);
$modelsCampeonato = Campeonato::find()->where(['estado' => true])->one();
$pathWeb = '';
if ($model->link_foto) {
    $pathWeb = Yii::getAlias('@web')  . $model->link_foto;
}
?>

<div class="jugador-form">

    <div class="text-center">

        <div class=" p-1  shadow d-inline-block rounded-circle">
            <?= Html::img($pathWeb, [
                'width' => '100px',
                'height' => '100px',
                'class' => 'rounded-circle border border-primary p-1 shadow'
            ]); ?>
        </div>
    </div>
    <p></p>

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>



    <?= $form->field($model, 'id_equipo')->textInput(['value' => $model->equipo->nombre, 'disabled' => true])->label('Equipo') ?>

    <?= $form->field($model, 'id_campeonato')->hiddenInput(['value' => $modelsCampeonato->id])->label(false) ?>

    <?= $form->field($model, 'code')->hiddenInput(['value' => '-'])->label(false) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_camiseta')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput(['type' => 'date'])->hint($aniosJugador, ['class' => 'text-success small ']) ?>


    <?= $form->field($model, 'cedula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_estado_civil')->dropDownList($arrayEstadoCivil, ['prompt' => 'Seleccione..'])->label('Estado Cívil') ?>

    <?= $form->field($model, 'hijos')->textInput() ?>

    <?= $form->field($model, 'link_foto')->fileInput() ?>




    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>