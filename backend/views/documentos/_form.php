<?php

use common\models\Campeonato;
use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */
/* @var $form yii\widgets\ActiveForm */
$modelCampeonato = Campeonato::find()->where(['estado'=>true])->all();
$arrayCampeonato = ArrayHelper::map($modelCampeonato,'id','nombre');

$modelsCatalogo = Catalogos::find()->where(['id_catalogo'=>25])->all();
$arrayCatalogo = ArrayHelper::map($modelsCatalogo,'id','valor');
?>

<div class="documentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_campeonato')->dropDownList($arrayCampeonato)->label('Campeonato') ?>

    <?= $form->field($model, 'id_tipo_documento')->dropDownList($arrayCatalogo)->label('Tipo Documento') ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
