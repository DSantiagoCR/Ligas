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

use yii\widgets\Pjax;

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
					<div class="card" style=" padding: 10px;">
						<div class="card-body">
							<div class="row">
								<div class="col-12 col-md-3 ">
									<img src="<?= $item->link_logotipo?>" class="card-img-top card-sm" alt="Descripción de la imagen"
										style="width: 100%; height: 100%">

								</div>
								<div class="col-12 col-md-9">
									<h5 class="card-title text-primary fw-bold mb-3"
										style="font-size: 1.25rem; letter-spacing: 0.05em;">
										<?= $item->nombre ?>
									</h5>
									<p class="card-text"></p>
									<!-- cat-gen -->
									<!-- <?= Html::button('<i class="fas fa-people-arrows"></i>', [
											'value' => Url::to(['modal-contenido','id_contenido'=>1,'id_equipo'=>$item->id]),
											'class' => 'btn btn-outline-primary btn-sm showModalButton',
											'id' => 'modalButton',//'catGenero'.$item->id,
											'title' => 'Categoria-Genero',
										]) ?> -->
									<!-- directivos -->
									<?= Html::button('<i class="fas fa-user-tie"></i>', [
										'value' => Url::to(['modal-contenido','id_contenido'=>2,'id_equipo'=>$item->id]),
										'class' => 'btn btn-outline-primary btn-sm showModalButton',
										'id' => 'modalButton',//'dir'.$item->id,
										'title' => 'Directivos',
									]) ?>
									<!-- Agregar jugadores	 -->
									<?= Html::button('<i class="far fa-address-card"></i>', [
										'value' => Url::to(['modal-contenido','id_contenido'=>3,'id_equipo'=>$item->id]),
										'class' => 'btn btn-outline-primary btn-sm showModalButton',
										'id' => 'modalButton',//'dir'.$item->id,
										'title' => 'Agregar Jugador',
									]) ?>
									<!-- Mostrar Jugadores - Categorias	 -->
										<?= Html::button('<i class="fas fa-address-book"></i>', [
										'value' => Url::to(['modal-contenido','id_contenido'=>3,'id_equipo'=>$item->id]),
										'class' => 'btn btn-outline-primary btn-sm showModalButton',
										'id' => 'modalButton',//'dir'.$item->id,
										'title' => 'Mostrar Jugadores Categoria',
									]) ?>
									<!-- Mostrartest	 -->
									 <?=Html::a('<i class="glyphicon glyphicon-plus"></i>', ['modal-contenido',
									 'id_contenido'=>3,'id_equipo'=>$item->id],
									 ['role'=>'modal-remote','title'=> 'Create new Jugadors','class'=>'btn btn-default'])
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
			</div> <!-- div row -->
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
    'title' => '',    
    'id' => 'myModal',
    'size' => Modal::SIZE_EXTRA_LARGE, // Tamaño del modal (modal-sm, modal-lg)
]);

echo "<div id='modalContent'></div>";

Modal::end();
?>

<?php 

Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
	'size' => Modal::SIZE_EXTRA_LARGE, // Tamaño del modal (modal-sm, modal-lg)
])
?>
<?php Modal::end(); ?>

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

