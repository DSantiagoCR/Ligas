<?php

use common\models\NucleArbitros;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$modelNucleoArbitros = NucleArbitros::find()->where(['estado'=>true])->all();
$arrayNucleoArbitros = ArrayHelper::map($modelNucleoArbitros,'id','nombre');
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
        'attribute'=>'code',
        'label'=>'Código',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'anio',
        'label'=>'Año',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_nucleo_arbitros',
        'label'=>'Nucleo Arbitros',
        'filter'=>$arrayNucleoArbitros,
        'value'=>function($model)
        {
            return $model->nucleoArbitros->nombre;
        }
    ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'estado',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'detalle',
    // ],
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
                          'data-confirm-title'=>'Eliminación?',
                          'data-confirm-message'=>'Está seguro de eliminar el registro ?'], 
    ],

];   