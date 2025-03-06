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
	<h1>Jugadores</h1>
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
											<div class="col-6">
												<img src="<?= $item->link_logotipo ?>" class="card-img-top card-xs" alt="Descripción de la imagen"
													style="width: 100%; height: 50px">

												<p class="card-title text-primary fw-bold mb-3"
													style="font-size: 1.25rem; letter-spacing: 0.05rem;">
													<?= $item->nombre ?>
												</p>

											</div>
											<div class="col-5">
												<!-- <?= Html::button('<i class="fas fa-user"></i>', [
															'value' => Url::to(['index', 'id_equipo' => $item->id]),
															'class' => 'btn btn-outline-primary btn-sm',
															'id' => 'modalButton', //'catGenero'.$item->id,
															'title' => 'Jugadores',
														]) ?> -->
												<?= Html::a('<i class="fas fa-user"></i>', ['index', 'id_equipo' => $item->id], [
													'class' => 'btn btn-outline-primary btn-sm',
													'id' => 'modalButton', // O un ID único como 'catGenero'.$item->id
													'title' => 'Jugadores'
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