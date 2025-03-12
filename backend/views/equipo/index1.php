<?php

use frontend\assets\AppAsset;


use common\models\Equipo;
use common\models\Util\HelperGeneral;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap5\Modal;
use hoaaah\ajaxcrud\CrudAsset;



/* @var $this yii\web\View */
/* @var $searchModel common\models\search\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipos Configuración';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs($this->render('/evento/jquery.blockUI.js'));
CrudAsset::register($this);
AppAsset::register($this);
$modelCategoriaEquipos = HelperGeneral::devuelveCategoriasEquiposObj();
$modelGenerosEquipos = HelperGeneral::devuelveGenerosEquiposObj();
?>

<div class="equipo-config-index">
	<div class="card p-1">
		<div class="row">
			<div class="col-2">
				<h3>Equipos</h3>
			</div>
			<div class="col">
				<?= Html::a('Configuración Equipos <i class="fas fa-shield-alt"></i>', ['index', 'id_equipo' => 1], [
					'class' => 'btn btn-outline-primary btn-sm',
					'id' => 'modalButton', // O un ID único como 'catGenero'.$item->id
					'title' => 'Crear Equipo'
				]) ?>
			</div>
		</div>
	</div>
	<?php
	foreach ($modelCategoriaEquipos as $categ) {
	?>
		<div class="card-header text-center" id="headingOne">
			<h5 class="mb-0">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample<?= $categ->id ?>" aria-expanded="false" aria-controls="collapseExample<?= $categ->id ?>">
						CATEGORIA : <?= $categ->valor ?> <i class="fas fa-arrow-circle-down"></i>
					</button>
				</p>
			</h5>
		</div>
		<div class="collapse" id="collapseExample<?= $categ->id ?>">
			<div class="card card-body">
				<?php
				foreach ($modelGenerosEquipos as $gene) {
				?>
					<p class="display-6 form-control text-ligth bg-info">GENERO : <?= $gene->valor ?></p>
					<?php
					$modelListEquipos = Equipo::find()
						->where(['id_categoria' => $categ->id])
						->andWhere(['id_genero' => $gene->id])
						->all();

					$cont = 0;
					foreach ($modelListEquipos as $item) {
					?>
						<?php
						if ($cont == 0) {
						?>
							<div class="row">
							<?php
						}
							?>
							<div class="col">
								<div class="card" style=" padding: 5px;">
									<div class="card-body">
										<div class="row">
											<div class="col-8">
												<!-- <img src="<?= $item->link_logotipo ?>" class="card-img-top card-xs" alt="Descripción de la imagen"
													style="width: 100%; height: 50px"> -->
												<div class="text-center">
													<?php
													$pathWeb = Yii::getAlias('@web');
													$pathWeb = $pathWeb . $item->link_logotipo ;
													?>
													<div class=" p-1  shadow d-inline-block rounded-circle">
														<?= Html::img($pathWeb, [
															'width' => '100px',
															'height' => '100px',
															'class' => 'rounded-circle border border-primary p-1 shadow'
														]); ?>
													</div>
												</div>
												<p></p>

												<p class="card-title text-primary fw-bold mb-3"
													style="font-size: 1rem; letter-spacing: 0.05rem;">
													<?= $item->nombre ?>
												</p>

											</div>
											<div class="col-4">
												<?= Html::a('<i class="fas fa-running fa-2x"></i>', ['jugador/index', 'id_equipo' => $item->id], [
													'class' => 'btn btn-outline-primary btn-sm',
													'id' => 'modalButton', // O un ID único como 'catGenero'.$item->id
													'title' => 'Jugadores'
												]) ?>
												<?= Html::a('<i class="fas fa-user-tie fa-2x"></i>', ['directivos/index', 'id_equipo' => $item->id], [
													'class' => 'btn btn-outline-primary btn-sm',
													'id' => 'modalButton', // O un ID único como 'catGenero'.$item->id
													'title' => 'Directivos'
												]) ?>

											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							$cont = $cont + 1;
							if ($cont == 6) {

								$cont = 0;
							?>
							</div> <!-- div row -->
						<?php
							}
						?>
					<?php
					} //for equipos

					if ($cont <> 0) {
					?>
			</div>
	<?php
					} // if 
				} // for genero
	?>
		</div> <!-- card body -->
</div> <!-- for categoria -->
<?php
	} //for categoria
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
	"id" => "ajaxCrudModal",
	"footer" => "", // always need it for jquery plugin
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