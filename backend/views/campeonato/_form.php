<?php

use common\models\NucleArbitros;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Campeonato */
/* @var $form yii\widgets\ActiveForm */

$modelNucleArbitros = NucleArbitros::find()->where(['estado'=>true])->all();
$arrayNucleoArbitros = ArrayHelper::map($modelNucleArbitros,'id','nombre');
?>

<div class="campeonato-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code',['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true])->label('Código')?>

    <?= $form->field($model, 'nombre',['errorOptions' => ['class' => 'text-danger']],)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anio',['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true])->label('Año') ?>

    <?= $form->field($model, 'id_nucleo_arbitros',['errorOptions' => ['class' => 'text-danger']])->dropDownList($arrayNucleoArbitros,['prompt'=>'Seleccione Opción'])->label('Nucleo Arbitros'); ?>

    <?= $form->field($model, 'estado')->checkbox(['label' => 'Activado'])->label(false) ?>

    <?= $form->field($model, 'detalle')->textarea(['rows' => 4]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
