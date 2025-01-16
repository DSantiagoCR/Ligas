<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GrupoEquipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-equipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_campeonato')->textInput() ?>

    <?= $form->field($model, 'id_grupo')->textInput() ?>

    <?= $form->field($model, 'id_equipo')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
