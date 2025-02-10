<?php

/** @var yii\web\View $this */

use common\models\Util\HelperGeneral;
use yii\helpers\Html;

$modelUserEquipo = HelperGeneral::devuelveEquipoUsuario();
$modelCampeonato = HelperGeneral::devuelveCampeonatoActual();
$this->title = 'Ligas';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <div class="row">
                <div class="col">
                    <h1 class="display-4">Bienvenido!</h1>
                    <?php
                    echo $this->render('_liga_barrial');
                    ?>
                    </br></br>
                    <b> <scan style="font-size: 20px;">Campeonato:</scan></b>
                    <?= $modelCampeonato->nombre?>
                    </br>
                    <b><scan style="font-size: 20px;">Periodo:</scan></b>
                    <?= $modelCampeonato->anio?>
                </div>
                <div class="col">    
                    <scan><b>Equipos Asociados</b></scan>  
                                 
                    <div class="row p-3">
                    <?php
                    if ($modelUserEquipo) {
                        foreach($modelUserEquipo as $model)
                        {
                    ?>
                    <div class="col">                
                        <div><?= Html::a( $model->equipo->nombre,['/principal/index','id'=>$model->id]); ?></div>
                        <div><?= Html::img($model->equipo->link_logotipo, ['width' => '100px']); ?></div>                    
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