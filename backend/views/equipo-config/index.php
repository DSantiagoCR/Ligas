<?php

use common\models\Catalogos;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel common\models\search\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipos Configuración';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs($this->render('/evento/jquery.blockUI.js'));
CrudAsset::register($this);
?>
<div class="equipo-config-index">

    <div class="card" style="width: 50rem; padding: 10px;">
        <?php $form = ActiveForm::begin(
			[
				'id' => 'form-add-contact',
				'enableAjaxValidation' => false,
				'validationUrl' => Yii::$app->urlManager->createUrl('/equipo-config/index'),
			]
		); ?>
        <?= $form->field($model, 'id')->dropDownList($arrayListEquipos, ['prompt' => 'Seleccione un equipo'])->label('Seleccione Equipos') ?>

        <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Ver' : 'Ver', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php } ?>

        <?php ActiveForm::end(); ?>
    </div>

    <?php
	//print_r($modelEquipoCategoria);
	/*****Carga categoria y genero*****/
	
	if ($listaJuagadores == null) {
		//echo 'S/N';
	} else {
		if ($modelEquipoCategoria) {
			//print_r('ingreso');
			echo $this->render('categoria-genero', 
			[
				'modelEquipoCategoria' => $modelEquipoCategoria,
				'modelListCategoria'=>$modelListCategoria,
				'modelListGenero'=>$modelListGenero,
				'modelEquipo'=>$model,
			]);
		}
	}

	/*****Directivos*****/
	
	if ($listaJuagadores == null) {
		//echo 'S/N';
	} else {
		if ($modelDirectivaEquipo) {
			echo $this->render('directivos', 
			[
				'modelDirectivaEquipo' => $modelDirectivaEquipo,
				'modelDirectivos' => $modelDirectivos,
				'modelListTipoDirectivos'=>$modelListTipoDirectivos,
				'modelCampeonato'=>$modelCampeonato,
				'modelEquipo'=>$model,
				
			]);
		}
	}

	?>

</div>
</div>

<script>
function mensajeProcesando() {
    $.blockUI({
        message: 'Processing please wait...'
    });
}

function mensajeDatoGuardados() {
    Swal.fire(
        'Genial !!',
        'Datos Guardados de Forma Correcta',
        'success'
    );
}

function mensajeDatoNoGuardados() {
    Swal.fire(
        'Opss!!',
        'Datos no Guardados',
        'error'
    )
}
</script>