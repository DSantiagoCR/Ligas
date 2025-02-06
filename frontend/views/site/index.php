<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Bienvenido!</h1>
            <?php              
                    echo $this->render('_liga_barrial');               
                     ?>
            <!-- <p class="fs-5 fw-light"><?= Yii::t('app/error', '404-No-Found') ?></p> -->
            <!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> -->
        </div>
    </div>

    <div class="body-content">
        <div>
            <div class="row">
                <div class="col-lg-4 ">
                    <h2>Mi Equipo</h2>
                    <ul>
                        <li>Jugadores</li>
                        <li>Directiva</li>
                        <li>Mi Equipo</li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h2>Estadisticas</h2>
                    <ul>
                        <li>Proximas Fechas</li>
                        <li>Estadisticas</li>
                        <li>Históricos</li>
                        <li>Vocalias</li>

                    </ul>
                </div>
                <div class="col-lg-4">
                   
                    <?php              
                    echo $this->render('_lista_docu');               
                     ?>
                </div>
            </div>
        </div>



    </div>
</div>

