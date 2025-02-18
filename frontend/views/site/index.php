<?php

/** @var yii\web\View $this */

use common\models\Util\HelperGeneral;
use yii\helpers\Html;

$modelUserEquipo = HelperGeneral::devuelveEquipoUsuario();
$modelEquipoCampActual = HelperGeneral::devuelveEquiposCampeonatoActual();
$modelCategorias = HelperGeneral::devuelveCategoriasEquipos();
$modelGeneros = HelperGeneral::devuelveGenerosEquipos();

$this->title = 'Ligas';

?>



<div class="site-index">
    <div class="bg-transparent rounded-3">
        <div class="container-fluid ">
            <div class="row text-center">
                <div class="col">
                    <h1 class="display-4">Bienvenido!</h1>
                    <?php
                    echo $this->render('_liga_barrial');
                    ?>

                </div>
            </div>
            <div class="row text-center mt-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <scan style="color:green;font-size:12px"><b> <i class="fas fa-futbol"></i> Equipos</b></scan>
                        </div>
                        <div class="card-body">
                            <scan style="color:green;font-size:40px"><b> <?= count($modelEquipoCampActual)  ?></b></scan>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <scan style="color:green;font-size:12px"><b> <i class="fas fa-network-wired"></i></i> Categorías</b></scan>
                        </div>
                        <div class="card-body">
                            <scan style="color:green;font-size:40px"><b> <?= count($modelCategorias) ?></b></scan>
                            <div>
                                <?php
                                foreach ($modelCategorias as $model) {
                                ?>
                                    <scan style="font-size: 12px;color:green"><i class="fas fa-star"></i><?= '    ' . $model ?></scan><br>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <scan style="color:green;font-size:12px"><b> <i class="fas fa-people-arrows"></i></i> Géneros</b></scan>

                        </div>
                        <div class="card-body">
                            <scan style="color:green;font-size:40px"><b> <?= count($modelGeneros) ?></b></scan>
                            <div>
                                <?php
                                foreach ($modelGeneros as $model) {
                                ?>

                                    <scan style="font-size: 12px;color:green"><i class="fas fa-star"></i><?= '    ' . $model ?></scan><br>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row text-center mt-5">

                <h2><b>Equipos Asociados</b></h2>

                <div class="row p-3">
                    <?php
                    if ($modelUserEquipo) {
                        foreach ($modelUserEquipo as $model) {
                    ?>
                            <div class="col text-center">
                                <div class="card d-inline-block">
                                    <div class="card-header">
                                        <?= Html::a($model->equipo->nombre, ['/principal/index', 'id' => $model->id]); ?>
                                    </div>
                                    <div class="card-body">
                                        <img src="<?= $model->equipo->link_logotipo ?>" style="width:100px" />

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
        <!-- <p class="fs-5 fw-light"><?= Yii::t('app/error', '404-No-Found') ?></p> -->
        <!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> -->
    </div>

</div>





</div>