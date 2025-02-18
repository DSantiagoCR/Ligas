<?php

use common\models\Menu;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
//Extraemos el Menu Padre
$modelMenuPadres = Menu::find()
    ->where(['parent'=>null])
    ->orderBy(['order'=>SORT_ASC])
    ->all();
$arrayMenuPadres = ArrayHelper::map($modelMenuPadres,'id','name');
$arrayActDesct = ['0'=>'Desactivado','1'=>'Activado'];
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->dropDownList(['0'=>'Backend','1'=>'Frontend'],['prompt'=>'Seleccione..']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Menú') ?>

    <?= $form->field($model, 'parent')->dropDownList($arrayMenuPadres)->label('Menú Padre')?>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true])->label('Ruta') ?>

    <?= $form->field($model, 'order')->textInput()->label('Orden') ?>

<!--    --><?php //= $form->field($model, 'data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true])->label('Icono') ?>

<!--    --><?php //= $form->field($model, 'option')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->dropDownList($arrayActDesct)->Label('Estado'); ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script>
    $(document).ready(function () {
        $('div .modal-header').html(' <h5 class="modal-title">Tipo Servicio</h5>');
    });
</script>