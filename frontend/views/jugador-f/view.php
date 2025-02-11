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
             //'id_equipo',
             [
                'label'=>'Equipo',
                'value'=>function($data){                   
                    return $data->equipo->nombre;                   
                }
            ],
            'nombres',
            'apellidos',
            'num_camiseta',
            'fecha_nacimiento',
            'cedula',
            'celular',
            // 'id_estado_civil',
            [
                'label'=>'Estado Civil',
                'value'=>function($data){                   
                    return $data->estadoCivil->valor;                   
                }
            ],
            'hijos',
            //'estado:boolean',
            [
                'label'=>'Estado',
                'value'=>function($data){                   
                    return ($data->estado)?'Activado':'Desactivado';                   
                }
            ],
           // 'link_foto',
           
            // 'puede_jugar:boolean',
            [
                'label'=>'Puede Jugar',
                'value'=>function($data){                   
                    return ($data->puede_jugar)?'SI':'NO';                   
                }
            ],
            'ta_acumulada',
            'ta_actuales',
            'tr_acumulada',
            'tr_actuales',
            //'goles',
            [
                'label'=>'Goles',
                'value'=>function($data){                   
                    return ($data->goles)?$data->goles:'0';                   
                }
            ],
            //'link_ficha',
        ],
    ]) ?>

</div>
