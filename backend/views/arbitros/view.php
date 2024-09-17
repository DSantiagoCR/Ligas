<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Arbitros */
?>
<div class="arbitros-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            //'id_nucleo_arbitro',
            [
                'label'=>'Nucleo Arbitros',                
                'value'=>function($data){                   
                    return $data->nucleoArbitro->nombre;                 
                }
            ],
            'nombre',
            'apellido',
            'calificacion_promedio',
            'fecha_nacimiento',
            'cedula',
            'hijos',
            //'estado:boolean',
            [
                'label'=>'Estado ',                
                'value'=>function($data){                   
                    return ($data->estado)?'Activado':'Desactivado';                 
                }
            ],
        ],
    ]) ?>

</div>
