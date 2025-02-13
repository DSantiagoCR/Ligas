<?php

/** @var yii\web\View $this */

use common\models\Util\HelperGeneral;
use yii\helpers\Html;

$modelUserEquipo = HelperGeneral::devuelveEquipoUsuario();

$this->title = 'Ligas';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 ">
            <div class="row text-center">
                <div class="col">
                    <h1 class="display-4">Bienvenido!</h1>
                    <?php
                    echo $this->render('_liga_barrial');
                    ?>
                </div>
                <div class="col">
                    <scan><b>Equipos Asociados</b></scan>

                    <div class="row p-3">
                        <?php
                        if ($modelUserEquipo) {
                            foreach ($modelUserEquipo as $model) {
                        ?>
                                <div class="col">
                                    <div class="card" style=" padding: 10px;">
                                        <div class="card-body">
                                            <div class="col">
                                                <div><?= Html::a($model->equipo->nombre, ['/principal/index', 'id' => $model->id]); ?></div>
                                                <div><?= Html::img($model->equipo->link_logotipo, [
                                                         //   'width' => '500px',
                                                            'height' => '150px',
                                                            'class' => 'card-img-top card-sm',
                                                        ]); ?>
                                                </div>
                                            </div>
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