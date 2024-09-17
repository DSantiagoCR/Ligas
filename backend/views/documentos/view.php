<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */
?>
<div class="documentos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_campeonato',
            [
                'label'=>'Campeonato',
                'value'=>function($model){
                    return $model->campeonato->nombre.' / '.$model->campeonato->anio;
                }
            ],
            //'id_tipo_documento',
            [
                'label'=>'Tipo Documento',
                'value'=>function($model){
                    return $model->tipoDocumento->valor;
                }
            ],           
            [
                'label'=>'Link',
                'format'=>'html',
                'value'=>function($data){                   
                    return Html::a(substr($data->link,0,40).'...', $data->link, ['target' => '_blank']);                   
                }
            ],
            
            'nombre',
            'descripcion',
        ],
    ]) ?>

</div>
