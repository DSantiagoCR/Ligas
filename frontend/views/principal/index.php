<?php

//use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
AppAsset::register($this);

?>

   <div class="principal-index">
    <div class="container-fluid py-5 ">
        <div class="row">
            <div class="col-lg text-center">
                <div><?= Html::a($modelUE->equipo->nombre, ['/principal/index', 'id' => $modelUE->id]); ?></div>
                <div><?= Html::img($modelUE->equipo->link_logotipo, ['width' => '130px']); ?></div>
            </div>
            <div class="col-lg">
                <h2>Estadisticas</h2>
                <ul>
                    <li>Proximas Fechas</li>
                    <li>Estadisticas</li>
                    <li>Históricos</li>
                    <li>Vocalias</li>

                </ul>
            </div>
            <div class="col-lg ">
                <h2>Mi Equipo</h2>
                <ul>
                    <li><?= Html::a('Jugadores', ['seleccion', 'indice' => 1, 'id_user_equipo' => $modelUE->id]) ?></li>
                    <li><?= Html::a('Jugadores', ['/jugador-f/index','id'=>1]) ?></li>

                    <li>Directiva</li>
                    <li>Mi Equipo</li>
                </ul>
            </div>
            <div class="col-lg">

                <?php
                echo $this->render('_lista_docu');
                ?>
            </div>
        </div>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-4">          
                <div class="col-lg">
                    <?php
                    if ($submenu) {
                        echo $submenu;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

