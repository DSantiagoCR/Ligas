<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CabeceraFechas */
?>
<div class="cabecera-fechas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'dia',
            'fecha',
            //'id_campeonato',
            [
                'attribute'=>'id_campeonato',
                'label'=>'Campeonato',
                'value'=>function($data)
                {
                    return $data->campeonato->nombre;
                }
            ],
            //'id_estado_fecha',
            [
                'attribute'=>'id_estado_fecha',
                'label'=>'Estado Fecha',
                'value'=>function($data)
                {
                    return $data->estadoFecha->valor;
                }
            ],
            //'estado:boolean',
            [
                'attribute'=>'estado',
                'label'=>'Estado',
                'value'=>function($data)
                {
                    return $data->estado?'Activado':'Desactivado';
                }
            ],
        ],
    ]) ?>

</div>
