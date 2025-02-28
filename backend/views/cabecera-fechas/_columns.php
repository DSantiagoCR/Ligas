<?php
use yii\helpers\Url;
use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

$modelCatalogos = Catalogos::find()->where(['id_catalogo' => '17'])->all();
$arrayCatalogos = ArrayHelper::map($modelCatalogos, 'id', 'valor');

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
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detailUrl' => Url::to(['/detalle-fecha/index1']),
        'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'num_fecha',
        'label'=>'Num. Fecha', 
        'format'=>'raw', 
        'value'=>function($data)
        {
            return '<div class="text-red text-lg text-center">'.$data->num_fecha.'</div>';
        }  
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dia',
        'label'=>'Dia Semana',
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha',
        'label'=>'Fecha Calendario',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_campeonato',
        'label'=>'Campeonato',
        'value' => function ($data) {
            return ($data->id_campeonato)?$data->campeonato->nombre:'';
        }
    ],
    [
        'attribute'=>'id_estado_fecha',
        'label'=>'Estado Fecha',
        'value'=>function($data)
        {
            return $data->estadoFecha->valor;
        }
    ],

    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'estado',
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
                          'data-confirm-message'=>'Esta seguro de eliminar el registro ?'], 
    ],

];   