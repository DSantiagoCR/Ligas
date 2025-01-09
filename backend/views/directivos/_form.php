<?php

use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Directivos */
/* @var $form yii\widgets\ActiveForm */

$modelsEstadoCivil = Catalogos::find()->where(['id_catalogo'=>10])->all();
$arrayEstadoCivil = ArrayHelper::map($modelsEstadoCivil,'id','valor');

?>

<div class="directivos-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'code',['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'nombre',['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido',['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento',['errorOptions' => ['class' => 'text-danger']])->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'cedula',['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true])->label('Cédula') ?>

    <?= $form->field($model, 'id_estado_civil',['errorOptions' => ['class' => 'text-danger']])->dropDownList($arrayEstadoCivil,['prompt'=>'Seleccione'])->label('Estado Civíl') ?>

    <?= $form->field($model, 'estado',['errorOptions' => ['class' => 'text-danger']])->checkbox(['label'=>'Activado'])->label(false) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
