<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Directivos */
?>
<div class="directivos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'code',
            'nombre',
            'apellido',
            'fecha_nacimiento',
            'cedula',
            //'id_estado_civil',      
            [
                'label'=>'Estado Civil ',                
                'value'=>function($data){                   
                    return $data->estadoCivil->valor;                
                }
            ],
            //'estado:boolean',
            [
                'label'=>'Estado',                
                'value'=>function($data){                   
                    return  ($data->estado)?'Activado':'Desactivado';                 
               
                }
            ],
        ],
    ]) ?>

</div>
