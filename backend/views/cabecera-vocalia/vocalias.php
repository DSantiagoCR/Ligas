<?php

use common\models\Util\HelperGeneral;
use yii\bootstrap5\Html;

$modelDiasHabiles = HelperGeneral::devuelveDiasHabilesObj();
$this->title = "Vocalias";
?>
<h3>Vocalias</h3>
<div class="container-fluid bg-light p-3">


    <div class="card d-inline-block">
        <div class="card-header">
            <h4 class="text-center">Próximas Fechas</h4>
        </div>
        <div class="card-body">
            <div class="row ">
                <?php
                foreach ($modelDiasHabiles as $model) {
                ?>
                    <div class="col">

                        <?= Html::a($model->valor, ['fechas', 'dia' => $model->valor], ['class' => 'btn btn-primary rounded-pill']) ?>

                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php if ($modelCabFechas && $modelDetFechas) { ?>

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

                    <div id="collapseOne_<?= $modelCab->id ?>" class="" aria-labelledby="headingOne" data-parent="#accordion_<?= $modelCab->id ?>">
                        <div class="card-body d-inline-block">
                            <?php
                            foreach ($modelDetFechas as $modelDet) {
                                if ($modelDet->id_cabecera_fecha == $modelCab->id) {

                            ?>
                                    <div class="card p-2  text-blue" style="background:#d7d7df">
                                        <div class="row justify-content-between ">
                                            <div class="col">
                                                <scan class="fw-bold bg-light  rounded-pill"><?= $modelDet->estadoPartido->valor ?></scan>
                                                <scan class="fw-bold bg-light  rounded-pill"> <?= $modelDet->horaInicio->valor ?></scan>
                                            </div>
                                            <div class="col">
                                                <div> <?= Html::img($modelDet->grupoEquipo1->equipo->link_logotipo, ['width' => '40px']) ?></div>
                                                <div><?= $modelDet->grupoEquipo1->equipo->nombre ?></div>
                                            </div>
                                            <div class="col">
                                                VS
                                            </div>

                                            <div class="col">
                                                <div> <?= Html::img($modelDet->grupoEquipo2->equipo->link_logotipo, ['width' => '40px']) ?></div>
                                                <div> <?= $modelDet->grupoEquipo2->equipo->nombre ?></div>
                                            </div>
                                            <div class="col">
                                                <?= $modelDet->etapa->valor ?>
                                            </div>
                                            <div class="col">
                                                <?= Html::a('Vocalia <i class="fas fa-hand-point-right"></i>', ['vocalia', 'idDetFec' => $modelDet->id], ['class' => 'btn btn-primary rounded-pill']) ?>
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
    <?php  } ?>
</div>