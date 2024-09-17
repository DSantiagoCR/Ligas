<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\NucleArbitros */
?>
<div class="nucle-arbitros-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'nombre',
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
