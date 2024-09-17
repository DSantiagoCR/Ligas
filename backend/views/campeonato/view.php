<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Campeonato */
?>
<div class="campeonato-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'nombre',
            //'anio',
            [
                'label'=>'Año',                
                'value'=>function($data){                   
                    return $data->anio;                 
                }
            ],
            //'id_nucleo_arbitros',
            [
                'label'=>'Nucleo Arbitros',                
                'value'=>function($data){                   
                    return $data->nucleoArbitros->nombre;                 
                }
            ],
            //'estado:boolean',
            [
                'label'=>'Estado ',                
                'value'=>function($data){                   
                    return ($data->estado)?'Activado':'Desactivado';                 
                }
            ],
            'detalle',
        ],
    ]) ?>

</div>
