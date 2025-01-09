<?php

use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$modelsEstadoCivil = Catalogos::find()->where(['id_catalogo'=>10])->all();
$arrayEstadoCivil = ArrayHelper::map($modelsEstadoCivil,'id','valor');

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    // [
    //     'class' => 'kartik\grid\SerialColumn',
    //     'width' => '30px',
    // ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'code',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'apellido',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_nacimiento',
        'filter'=>'',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cedula',
        'label'=>'Cédula',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_estado_civil',
        'label'=>'Estado Civil',
        'filter'=>$arrayEstadoCivil,
        'value'=>function($model)
            {
                return ($model->estadoCivil)?$model->estadoCivil->valor:'';
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
                          'data-confirm-title'=>'Eliminación',
                          'data-confirm-message'=>'Está Seguro de eliminar el registro ?'], 
    ],

];   