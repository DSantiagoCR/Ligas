<?php

use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Grupos */
/* @var $form yii\widgets\ActiveForm */

$modelEtapas = Catalogos::find()->where(['id_catalogo'=>27])->all();
$arrayEtapas = ArrayHelper::map($modelEtapas,'id','valor');

$modelGenero = Catalogos::find()->where(['id_catalogo'=>17])->all();
$arrayGenero = ArrayHelper::map($modelGenero,'id','valor');

$modelCategoria = Catalogos::find()->where(['id_catalogo'=>21])->all();
$arrayCategoria = ArrayHelper::map($modelCategoria,'id','valor');
?>

<div class="grupos-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true,'value'=>'-','style' => 'display:none;'])->label(false) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'id_catalogo')->dropDownList($arrayEtapas,['prompt'=>'Seleccione...'])->label('Etapa')?>

	<?= $form->field($model, 'id_genero')->dropDownList($arrayGenero,['prompt'=>'Seleccione...'])->label('Genero')?>

	<?= $form->field($model, 'id_categoria')->dropDownList($arrayCategoria,['prompt'=>'Seleccione...'])->label('Categoria')?>

	<div class="form-check form-switch">
		<?= $form->field($model, 'estado')->checkbox()?>
	</div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
