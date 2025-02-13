<?php

//use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;

AppAsset::register($this);

?>

<div class="principal-index">
    <div class="container-fluid py-1 ">

        <div class="row">
            <div class="col">
                <div class="card" style=" padding: 0px;">
                    <div class="card-body text-center">
                        <div><?= Html::a($modelUE->equipo->nombre, ['/principal/index', 'id' => $modelUE->id]); ?></div>
                        <div>
                            <?= Html::img($modelUE->equipo->link_logotipo, [
                                'width' => '100px',
                                'height' => '100px',
                                'class' => 'card-img-top card-sm',
                            ]); ?>
                        </div>
                        <div><?= Html::tag('p', $modelUE->equipo->genero->valor, ['style' => 'color: green; font-size: 15px;']) ?></div>
                        <div><?= Html::tag('p', $modelUE->equipo->categoria->valor, ['style' => 'color: green; font-size: 15px;']) ?></div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-9">
                <div class="row">
                    <div class="col">
                        <?php
                        if ($submenu) {
                            echo $submenu;
                        }
                        ?>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="card " style=" padding: 20px;">
            <div class="row">

                <div class="col-lg">
                    <h3>Estadisticas</h3>
                    <ul>
                        <li>Proximas Fechas</li>
                        <li>Estadisticas</li>
                        <li>Históricos</li>
                        <li>Vocalias</li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="card " style=" padding: 20px;">

            <div class="row">
                <div class="col-lg ">
                    <h3>Mi Equipo</h3>
                    <ul>
                        <li><?= Html::a('Jugadores', ['/jugador-f/index', 'id' => $modelUE->id_equipo]) ?></li>
                        <li><?= Html::a('Directivos', ['/directivos-f/index', 'id' => $modelUE->id_equipo]) ?></li>                      
                        <li>Mi Equipo</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card " style=" padding: 20px;">
            <div class="row">
                <div class="col-lg">

                    <?php
                    echo $this->render('_lista_docu');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>