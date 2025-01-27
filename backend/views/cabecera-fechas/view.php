<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CabeceraFechas */
?>
<div class="cabecera-fechas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dia',
            'fecha',
            'id_campeonato',
            'id_estado_fecha',
            'estado:boolean',
        ],
    ]) ?>

</div>
