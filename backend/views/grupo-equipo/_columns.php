<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_campeonato',
        'label'=>'Campeonato',
        'value'=>function($model)
        {
            return $model->campeonato->nombre;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_grupo',
        'label'=>'Grupo',
        'value'=>function($model)
        {
            return $model->grupo->nombre;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_equipo',
        'label'=>'Equipo',
        'value'=>function($model)
        {
            return $model->equipo->nombre;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Logo',
        'format'=>'html',
        'value'=>function($model)
        {
            return Html::img($model->equipo->link_logotipo,['width'=>'40px']) ;
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Eliminar',
                          'data-confirm-message'=>'Esta seguro de eliminar el registro?'], 
    ],

];   