<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DetalleFecha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-fecha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cabecera_fecha')->textInput() ?>

    <?= $form->field($model, 'id_grupo')->textInput() ?>

    <?= $form->field($model, 'id_grupo_equipo1')->textInput() ?>

    <?= $form->field($model, 'id_grupo_equipo2')->textInput() ?>

    <?= $form->field($model, 'goles_equipo1')->textInput() ?>

    <?= $form->field($model, 'goles_equipo2')->textInput() ?>

    <?= $form->field($model, 'hora_inicio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_estado_partido')->textInput() ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

    <?= $form->field($model, 'id_etapa')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
