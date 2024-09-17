<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model common\models\Equipo */
?>
<div class="equipo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'nombre',
            'fecha_fundacion',
            //'link_logotipo',
            [
                'label'=>'Link Logotipo',
                'format'=>'html',
                'value'=>function($data){                   
                    return Html::a(substr($data->link_logotipo,0,40).'...', $data->link_logotipo, ['target' => '_blank']);                   
                }
            ],
            //'activo:boolean',
            [
                'label'=>'Estado ',                
                'value'=>function($data){                   
                    return ($data->activo)?'Activado':'Desactivado';                 
                }
            ],
            //'id_genero',
            [
                'label'=>'Género',
                'value'=>function($data){                   
                    return $data->genero->valor;                   
                }
            ]
        ],
    ]) ?>

</div>
