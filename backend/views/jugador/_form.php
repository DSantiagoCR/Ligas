<?php

use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
/* @var $form yii\widgets\ActiveForm */

$modelsEstadoCivil = Catalogos::find()->where(['id_catalogo'=>10])->all();
$arrayEstadoCivil = ArrayHelper::map($modelsEstadoCivil,'id','valor');

?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'cedula')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'celular')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'id_estado_civil')->dropDownList($arrayEstadoCivil)->label('Estado Cívil') ?>

    <?= $form->field($model, 'hijos')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
