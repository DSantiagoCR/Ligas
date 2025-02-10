<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'cedula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_estado_civil')->textInput() ?>

    <?= $form->field($model, 'hijos')->textInput() ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

    <?= $form->field($model, 'link_foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_equipo')->textInput() ?>

    <?= $form->field($model, 'puede_jugar')->checkbox() ?>

    <?= $form->field($model, 'ta_acumulada')->textInput() ?>

    <?= $form->field($model, 'ta_actuales')->textInput() ?>

    <?= $form->field($model, 'tr_acumulada')->textInput() ?>

    <?= $form->field($model, 'tr_actuales')->textInput() ?>

    <?= $form->field($model, 'goles')->textInput() ?>

    <?= $form->field($model, 'link_ficha')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
