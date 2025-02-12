<?php
use yii\helpers\Url;

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
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'code',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombres',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'apellidos',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'num_camiseta',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fecha_nacimiento',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cedula',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'celular',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_estado_civil',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'hijos',
    // ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'estado',
        'value'=>function($data)
        {
            return $data->estado?'<scan style="color:green">ACTIVADO</scan>':'<scan style="color:red">DESACTIVADO</scan>';
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'link_foto',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_equipo',
    // ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'puede_jugar',
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ta_acumulada',
        'label'=>'T.A.A'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ta_actuales',
        'label'=>'T.A.'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tr_acumulada',
        'label'=>'T.R.A'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tr_actuales',
        'label'=>'T.R'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'goles',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'link_ficha',
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
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   