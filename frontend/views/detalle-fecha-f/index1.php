<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;
use hoaaah\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DetalleFechaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


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
        <div class="card text-center bg-transparent">
            <div class="card-header bg-white " id="headingOne">
                <h5 class="mb-0">                   
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseExample<?= $modelCab->id ?>" aria-expanded="false" aria-controls="collapseExample<?=$modelCab->id ?>">
                        <b class="fs-4 text-blue">Fecha: <?= $modelCab->num_fecha ?></b>
                        <scan style="color:green "><b><?= $modelCab->dia ?></b> <?= '   ' . $modelCab->fecha ?> (<?= $modelCab->estadoFecha->valor ?>) <i class="fas fa-arrow-circle-down"></i></scan>
                    </button>
                </h5>
            </div>
     
            <div class="collapse" id="collapseExample<?= $modelCab->id ?>">
                <div class="card-body d-inline-block bg-transparent">
                    <?php
                    foreach ($modelDetFechas as $modelDet) {
                        if ($modelDet->id_cabecera_fecha == $modelCab->id) {

                    ?>
                            <div class="card p-2  text-white border border-warning bg-transparent">
                                <div class="row justify-content-between ">
                                    <div class="col">
                                        <scan class="fw-bold bg-light  rounded-pill p-1"><?= $modelDet->estadoPartido->valor ?></scan>
                                        <scan class="fw-bold bg-light  rounded-pill p-1"> <?= $modelDet->horaInicio->valor ?></scan>
                                    </div>
                                    <div class="col">
                                        <!-- <div> <?= Html::img($modelDet->grupoEquipo1->equipo->link_logotipo, ['width' => '40px']) ?></div> -->
                                        <div class="text-center">
                                            <?php
                                            $pathWeb = Yii::getAlias('@web');
                                            $pathWeb = $pathWeb . '/administrator';
                                            $pathWeb = $pathWeb . $modelDet->grupoEquipo1->equipo->link_logotipo;
                                            ?>
                                            <div class=" p-1  shadow d-inline-block rounded-circle">
                                                <?= Html::img($pathWeb, [
                                                    'width' => '80px',
                                                    'height' => '80px',
                                                    'class' => 'rounded-circle border border-warning p-1 shadow'
                                                ]); ?>
                                            </div>
                                        </div>
                                        <p></p>
                                        <div><?= $modelDet->grupoEquipo1->equipo->nombre ?></div>
                                        <?php
                                        $iconoBandera = "";
                                        if ($modelDet->ganador1 == 1) {
                                            $iconoBandera = '<i class="fas fa-flag" style="color:#84e600"></i>';
                                        }

                                        ?>
                                        <div><?= $iconoBandera ?></div>
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
                                        <!-- <div> <?= Html::img($modelDet->grupoEquipo2->equipo->link_logotipo, ['width' => '40px']) ?></div> -->
                                        <div class="text-center">
                                            <?php
                                            $pathWeb = Yii::getAlias('@web');
                                            $pathWeb = $pathWeb . '/administrator';
                                            $pathWeb = $pathWeb . $modelDet->grupoEquipo2->equipo->link_logotipo;
                                            ?>
                                            <div class=" p-1  shadow d-inline-block rounded-circle">
                                                <?= Html::img($pathWeb, [
                                                    'width' => '80px',
                                                    'height' => '80px',
                                                    'class' => 'rounded-circle border border-warning p-1 shadow'
                                                ]); ?>
                                            </div>
                                        </div>
                                        <p></p>
                                        <div> <?= $modelDet->grupoEquipo2->equipo->nombre ?></div>
                                        <?php
                                        $iconoBandera = "";
                                        if ($modelDet->ganador2 == 1) {
                                            $iconoBandera = '<i class="fas fa-flag" style="color:#84e600"></i>';
                                        }

                                        ?>
                                        <div> <?= $iconoBandera ?></div>
                                    </div>
                                    <div class="col">
                                        <?= $modelDet->etapa->valor ?>
                                    </div>
                                </div>
                            </div>
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