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
    <?php
		$cont = 0;
			foreach($modelListEquipos as $item)
			{ 
		?>
		<?php
				if ($cont==0)
				{ 					
		?>
			<div class="row">
		<?php
				} 					
		?>
				<div class="col">
					<div class="card" style="width: 30rem; padding: 10px;">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<img src="<?= $item->link_logotipo?>" class="card-img-top card-sm" alt="Descripción de la imagen"
										style="width: 100px; height: 100px;">

								</div>
								<div class="col-9">
									<h5 class="card-title text-primary fw-bold mb-3"
										style="font-size: 1.25rem; letter-spacing: 0.05em;">
										<?= $item->nombre ?>
									</h5>
									<p class="card-text"></p>
									<?= Html::button('<i class="fas fa-trash-alt fa-xs"></i>', [
											'value' => Url::to(['modal-contenido','id_contenido'=>1,'id_equipo'=>$item->id]),
											'class' => 'btn btn-outline-primary btn-sm showModalButton',
											'id' => 'modalButton',//'catGenero'.$item->id,
											'title' => 'Categoria-Genero',
										]) ?>
									<?= Html::button('<i class="fas fa-trash-alt fa-xs"></i>', [
										'value' => Url::to(['modal-contenido','id_contenido'=>2,'id_equipo'=>$item->id]),
										'class' => 'btn btn-outline-primary btn-sm showModalButton',
										'id' => 'modalButton',//'dir'.$item->id,
										'title' => 'Directivos',
									]) ?>
									<?=
									 Html::a('<i class="glyphicon glyphicon-plus"></i>', ['modal-contenido','id_contenido'=>1,'id_equipo'=>$item->id],
									 ['role'=>'myModal','title'=> 'Create new Equipos','class'=>'btn btn-default'])
									 ?>
								</div>
							</div>
						</div>
					</div>
				</div>
		<?php
				$cont=$cont+1;				
				if ($cont==3)
				{ 	
					$cont=0;				
		?>
			</div>
		<?php
				} 
							
		?>
    <?php				
			}//for 

		?>
		<?php						
			if ($cont<>0)
			{ 								
		?>
			</div>
		<?php
			} 							
		?>

</div>

<?php
Modal::begin([
    'title' => '<h4>Modal con AJAX</h4>',    
    'id' => 'myModal',
    'size' => Modal::SIZE_EXTRA_LARGE, // Tamaño del modal (modal-sm, modal-lg)
]);

echo "<div id='modalContent'></div>";

Modal::end();
?>

<script>

$(function() { 
	
	$('.showModalButton').click(function() {
        $('#myModal').modal('show') // Mostrar el modal			
            .find('#modalContent') // Buscar el div donde se cargará el contenido
			.empty() // Limpiar el contenido anterior
            .load($(this).attr('value')); // Cargar el contenido desde la URL especificada en el botón
    });

});

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

