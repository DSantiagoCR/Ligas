<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Catalogos */
?>
<div class="catalogos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'valor',
            'descripcion',
            //'estado:boolean',
            [
                'label'=>'Estado ',                
                'value'=>function($data){                   
                    return ($data->estado)?'Activado':'Desactivado';                 
                }
            ],
            //'id_catalogo',
            [
                'label'=>'Catálogo Padre',                
                'value'=>function($data){                   
                    return ($data->id_catalogo)?$data->catalogo->valor:'';                 
                }
            ],
        ],
    ]) ?>

</div>
