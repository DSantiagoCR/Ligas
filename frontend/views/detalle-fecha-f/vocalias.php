<?php

use common\models\CabeceraVocalia;
use common\models\Util\HelperGeneral;
use yii\bootstrap5\Html;
use frontend\assets\AppAsset;
use hoaaah\ajaxcrud\CrudAsset;

$modelDiasHabiles = HelperGeneral::devuelveDiasHabilesObj();
$this->title = "Vocalias";
CrudAsset::register($this);
AppAsset::register($this);
?>
<div class="card d-inline-block bg-transparent border border-warning shadow">
    <div class="card-header bg-transparent border border-warning shadow">
        <h4 class="text-center bg-transparent text-white ">Ingresar a Vocalia</h4>
    </div>
    <div class="card-body bg-transparent">
        <div class="row ">
            <?php
            foreach ($modelDiasHabiles as $model) {
            ?>
                <div class="col">

                    <?= Html::a($model->valor, ['fechas', 'dia' => $model->valor], ['class' => 'btn btn-warning rounded-pill']) ?>

                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- <div class="container-fluid bg-light p-3 bg-transparent"> -->


    <?php if ($modelCabFechas && $modelDetFechas) { ?>

        <?php
        foreach ($modelCabFechas as $modelCab) {
        ?>
            <div id="accordion_<?= $modelCab->id ?>">
                <div class="card text-center bg-transparent ">
                    <div class="card-header bg-white" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_<?= $modelCab->id ?>" aria-expanded="true" aria-controls="collapseOne_<?= $modelCab->id ?>">
                                <b>Fecha:</b>
                                <scan style="color:gray"><?= $modelCab->dia ?></scan> <?= '   ' . $modelCab->fecha ?> (<?= $modelCab->estadoFecha->valor ?>) <i class="fas fa-arrow-circle-down"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne_<?= $modelCab->id ?>" class="" aria-labelledby="headingOne" data-parent="#accordion_<?= $modelCab->id ?>">
                        <div class="card-body shadow d-inline-block  ">
                            <?php
                            foreach ($modelDetFechas as $modelDet) {
                                if ($modelDet->id_cabecera_fecha == $modelCab->id) {
                                    $modelCabVocalia = CabeceraVocalia::find()->where(['id_det_fecha' => $modelDet->id])->one();

                            ?>
                                    <div class="card p-2  text-white bg-transparent border border-warning " style="background:#d7d7df">
                                        <div class="row  justify-content-between">
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
                                                            'class' => 'rounded-circle border border-primary p-1 shadow'
                                                        ]); ?>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <div class="text-bold"><?= $modelDet->grupoEquipo1->equipo->nombre ?></div>
                                            </div>
                                            <div class="col text-bold">
                                                VS
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
                                                            'class' => 'rounded-circle border border-primary p-1 shadow'
                                                        ]); ?>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <div class="text-bold"> <?= $modelDet->grupoEquipo2->equipo->nombre ?></div>
                                            </div>
                                            <div class="col text-bold">
                                                <?= $modelDet->etapa->valor ?>
                                            </div>
                                            <div class="col-2 text-bol">
                                                <p style="color:white;font-size:12px">Vocal</p>
                                                <span class="bg-green p-1 text-bold"><?= $modelCabVocalia->id_equipo_vocal ? $modelCabVocalia->equipoVocal->nombre : '' ?></span>
                                            </div>
                                            <div class="col-2">
                                                <p style="color:white;font-size:12px">Veedor</p>
                                                <span class="bg-green p-1 text-bold"><?= $modelCabVocalia->id_equipo_veedor ? $modelCabVocalia->equipoVeedor->nombre : '' ?></span>
                                            </div>
                                            <div class="col text-bold">
                                                <?= Html::a('Vocalia <i class="fas fa-hand-point-right"></i>', ['vocalia', 'idDetFec' => $modelDet->id], ['class' => 'btn btn-primary rounded-pill text-bold']) ?>
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
<!-- </div> -->