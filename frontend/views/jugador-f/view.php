<?php

use common\models\Util\HelperGeneral;
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
            //'fecha_nacimiento',
            [
                'label'=>'Fecha Nacimiento',
                'format'=>'raw',
                'value'=>function($data){                   
                    $aniosJugador =  HelperGeneral::calcularEdadCompleta($data->fecha_nacimiento);
                    $aniosJugador = '<scan style="color:green"><b>('.$aniosJugador.')</b></scan>';
                    return ($data->fecha_nacimiento)?($data->fecha_nacimiento.' '.$aniosJugador.''):'';               
                }
            ],
            'cedula',
            'celular',
            // 'id_estado_civil',
            [
                'label'=>'Estado Civil',
                'value'=>function($data){                   
                    return ($data->id_estado_civil)?$data->estadoCivil->valor:'';                   
                }
            ],
            'hijos',
            //'estado:boolean',
            [
                'label'=>'Estado',
                'format'=>'raw',
                'value'=>function($data)
                {
                    return $data->estado?'<scan style="color:green"><b>ACTIVADO</b></scan>':'<scan style="color:red"><b>DESACTIVADO</b></scan>';
                }
            ],
           // 'link_foto',
           
            // 'puede_jugar:boolean',
            [
                'label'=>'Puede Jugar',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->puede_jugar?'<scan style="color:green"><b>SI</b></scan>':'<scan style="color:red"><b>NO</b></scan>';                
                }
            ],
            // 'ta_acumulada',
            [
                'label'=>'T.A Acumulada',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->ta_acumulada;              
                }
            ],
            //'ta_actuales',
            [
                'label'=>'T.A Actuales',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->ta_actuales;              
                }
            ],
            //'tr_acumulada',
            [
                'label'=>'T.R Acumulada',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->tr_acumulada;              
                }
            ],
            //'tr_actuales',
            [
                'label'=>'T.R Actuales',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->tr_actuales;              
                }
            ],
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
