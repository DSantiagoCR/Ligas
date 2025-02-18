<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CabeceraVocalia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cabecera-vocalia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_campeonato')->textInput() ?>

    <?= $form->field($model, 'ta_e1')->textInput() ?>

    <?= $form->field($model, 'ta_e2')->textInput() ?>

    <?= $form->field($model, 'tr_e1')->textInput() ?>

    <?= $form->field($model, 'tr_e2')->textInput() ?>

    <?= $form->field($model, 'informe_vocal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'informe_veedor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_arbitro')->textInput() ?>

    <?= $form->field($model, 'informe_arbitro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'novedades_equipo_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'novedades_equipo_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'novedades_generales')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'novedades_directiva')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_estado_vocalia')->textInput() ?>

    <?= $form->field($model, 'link_documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hora_empieza')->textInput() ?>

    <?= $form->field($model, 'hora_termina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_equipo_1')->textInput() ?>

    <?= $form->field($model, 'id_equipo_2')->textInput() ?>

    <?= $form->field($model, 'id_equipo_vocal')->textInput() ?>

    <?= $form->field($model, 'id_equipo_veedor')->textInput() ?>

    <?= $form->field($model, 'id_cab_fecha')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
