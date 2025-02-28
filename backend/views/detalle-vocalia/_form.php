<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DetalleVocalia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-vocalia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cabecera_vocalia')->textInput() ?>

    <?= $form->field($model, 'ta')->textInput() ?>

    <?= $form->field($model, 'tr')->textInput() ?>

    <?= $form->field($model, 'goles')->textInput() ?>

    <?= $form->field($model, 'entrega_carnet')->checkbox() ?>

    <?= $form->field($model, 'id_jugador')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
