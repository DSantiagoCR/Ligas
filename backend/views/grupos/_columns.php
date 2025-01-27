<?php

use common\models\Catalogos;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$modelEtapas = Catalogos::find()->where(['id_catalogo'=>27])->all();
$arrayEtapas = ArrayHelper::map($modelEtapas,'id','valor');

$modelGenero = Catalogos::find()->where(['id_catalogo'=>17])->all();
$arrayGenero = ArrayHelper::map($modelGenero,'id','valor');

$modelCategoria = Catalogos::find()->where(['id_catalogo'=>21])->all();
$arrayCategoria = ArrayHelper::map($modelCategoria,'id','valor');
return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detailUrl' => Url::to(['/grupo-equipo/index1']),
        'headerOptions' => ['class' => 'kartik-sheet-style']
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
        'attribute'=>'nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_catalogo',
        'label'=>'Etapa',
        'filter'=>$arrayEtapas,
        'format'=>'html',
        'value'=>function($data){
            return '<span style="color:red"><b>'.$data->catalogo->valor.'</b></span>';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_genero',
        'label'=>'Género',
        'filter'=>$arrayGenero,
        'format'=>'html',
        'value'=>function($data){
            return '<span style="color:green"><b>'.$data->genero->valor.'</b></span>';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_categoria',
        'label'=>'Categoría',
        'filter'=>$arrayCategoria,
        'format'=>'html',
        'value'=>function($data){
            return '<span style="color:blue"><b>'.$data->categoria->valor.'</b></span>';
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
                          'data-confirm-message'=>'Esta seguro de eliminar ?'], 
    ],

];   