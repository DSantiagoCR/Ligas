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
                <div class="card text-center">
                    <div class="card-header fw-bold">
                        <?= Html::a($modelUE->equipo->nombre, ['/principal/index', 'id' => $modelUE->id]); ?>
                    </div>
                    <div class="card-body">
                        <img src="<?= $modelUE->equipo->link_logotipo ?>" style="width:150px" />
                    </div>
                    <div><?= Html::tag('p', $modelUE->equipo->genero->valor, ['style' => 'color: green; font-size: 15px;']) ?></div>
                    <div><?= Html::tag('p', $modelUE->equipo->categoria->valor, ['style' => 'color: green; font-size: 15px;']) ?></div>
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

            <div class="col">
                <div class="card">
                    <div class="card-header fw-bold">Estadisticas</div>
                    <div class="card-body">
                        <ul>
                            <li>Proximas Fechas</li>
                            <li>Estadisticas</li>
                            <li>Históricos</li>
                            <li>Vocalias</li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header fw-bold">Mi Equipo</div>
                    <div class="card-body">
                        <ul>
                            <li><?= Html::a('Jugadores', ['/jugador-f/index', 'id' => $modelUE->id_equipo]) ?></li>
                            <li><?= Html::a('Directivos', ['/directivos-f/index', 'id' => $modelUE->id_equipo]) ?></li>
                            <li>Mi Equipo</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header fw-bold">Documentos</div>
                    <div class="card-body">
                        <?php
                        echo $this->render('_lista_docu');
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>