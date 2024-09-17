<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LigaBarrial */
?>
<div class="liga-barrial-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'nombre',
            'fecha_fundacion',
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
