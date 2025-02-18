<?php

use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;
use common\models\Util\HelperGeneral;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DetalleFechaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$modelCampeonato = HelperGeneral::devuelveCampeonatoActual();
$this->title = 'Próxima Fecha ';
// $this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
AppAsset::register($this);
?>

<h1 class="text-center">Próximas Fechas</h1>

<?php
foreach ($modelCabFechas as $modelCab) {
?>
    <div id="accordion_<?= $modelCab->id ?>">
        <div class="card text-center ">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_<?= $modelCab->id ?>" aria-expanded="true" aria-controls="collapseOne_<?= $modelCab->id ?>">
                        <b>Fecha:</b>
                        <scan style="color:gray"><?= $modelCab->dia ?></scan> <?= '   ' . $modelCab->fecha ?> (<?= $modelCab->estadoFecha->valor ?>) <i class="fas fa-arrow-circle-down"></i>
                    </button>
                </h5>
            </div>

            <div id="collapseOne_<?= $modelCab->id ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion_<?= $modelCab->id ?>">
                <div class="card-body d-inline-block">
                    <?php
                    foreach ($modelDetFechas as $modelDet) {
                        if ($modelDet->id_cabecera_fecha == $modelCab->id) {

                    ?>
                            <div class="card p-2  text-white  " style="background:#0076e6">
                                <div class="row justify-content-between ">
                                    <div class="col">
                                        <scan class="fw-bold bg-light  rounded-pill"><?= $modelDet->estadoPartido->valor ?></scan>
                                        <scan class="fw-bold bg-light  rounded-pill"> <?= $modelDet->horaInicio->valor ?></scan>
                                    </div>
                                    <div class="col">
                                        <div> <?= Html::img($modelDet->grupoEquipo1->equipo->link_logotipo, ['width' => '40px']) ?></div>
                                        <div><?= $modelDet->grupoEquipo1->equipo->nombre ?></div>
                                        <?php
                                        $iconoBandera = "";
                                        if ($modelDet->ganador1 == 1) {
                                            $iconoBandera = '<i class="fas fa-flag" style="color:#84e600"></i>';
                                        }

                                        ?>
                                        <div><?= $iconoBandera?></div>
                                    </div>
                                    <div class="col">
                                        <div class="badge bg-danger rounded-pill">
                                            <span class="bg-grey-300 text-xl font-medium px-2  rounded-full	whitespace-pre">
                                                <?= $modelDet->goles_equipo1 ?>
                                                -
                                                <?= $modelDet->goles_equipo2 ?>
                                            </span>
                                        </div>

                                        <div class="fw-bold"><?= $modelDet->grupo->genero->valor ?></div>
                                        <div class="fw-bold"><?= $modelDet->grupo->categoria->valor ?></div>

                                    </div>

                                    <div class="col">
                                        <div> <?= Html::img($modelDet->grupoEquipo2->equipo->link_logotipo, ['width' => '40px']) ?></div>
                                        <div> <?= $modelDet->grupoEquipo2->equipo->nombre ?></div>
                                        <?php
                                        $iconoBandera = "";
                                        if ($modelDet->ganador2 == 1) {
                                            $iconoBandera = '<i class="fas fa-flag" style="color:#84e600"></i>';
                                        }

                                        ?>
                                        <div> <?= $iconoBandera?></div>
                                    </div>
                                    <div class="col">
                                        <?= $modelDet->etapa->valor ?>
                                    </div>
                                </div>

                            </div>
                            <br>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>