<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
?>
<div class="jugador-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'code',
            'nombres',
            'apellidos',
            'fecha_nacimiento',
            'cedula',
            'celular',
            //'id_estado_civil',
            [
                'label'=>'Estado Civil',
                'value'=>function($data){                   
                    return $data->estadoCivil->valor;                   
                }
            ],
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
