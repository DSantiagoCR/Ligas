<?php
use yii\helpers\Url;
use common\models\Catalogos;
use yii\helpers\ArrayHelper;

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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dia',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha',
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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_estado_fecha',
        'label' => 'Estado Fecha',
        'filter' => $arrayCatalogos,
        'value' => function ($model) {
            return ($model->id_genero)?$model->genero->valor:'';
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
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   