<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
$modelMenuPadres = \common\models\Menu::find()
    ->where(['parent'=>null])
    ->orderBy(['order'=>SORT_ASC])
    ->all();
$arrayMenuPadres = ArrayHelper::map($modelMenuPadres,'id','name');
return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tipo',
        'label'=>'Tipo',
        'filter'=>['0'=>'Backend','1'=>'Frontend'],
        'value'=>function($data)
        {
            return $data->tipo==0?'Backend':'Frontend';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
        'label'=>'Menú',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'parent',
        'label'=>'Menú Padre',
        'filter'=>$arrayMenuPadres,
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => 'Buscar'],
            'pluginOptions' => ['allowClear' => true],
        ],
        'value'=>function($data){
            $modelo = \common\models\Menu::findOne($data->parent);
            return ($modelo)?$modelo->name:'-';
        },
        'width'=>'200px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'route',
        'label'=>'Ruta'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'order',
        'label'=>'Orden'
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'data',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'icon',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'option',
    // ],
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
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Actualizar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Eliminar',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Eliminación',
                          'data-confirm-message'=>'¿Está seguro de eliminar el registro?'],
    ],

];   