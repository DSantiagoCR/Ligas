<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CabeceraFechas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cabecera-fechas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'id_campeonato')->textInput() ?>

    <?= $form->field($model, 'id_estado_fecha')->textInput() ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
