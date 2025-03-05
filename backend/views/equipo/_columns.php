<?php

use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$modelCatalogos = Catalogos::find()->where(['id_catalogo' => '17'])->all();
$arrayCatalogos = ArrayHelper::map($modelCatalogos, 'id', 'valor');

$modelCategoria = Catalogos::find()->where(['id_catalogo' => '21'])->all();
$arrayCategoria = ArrayHelper::map($modelCategoria, 'id', 'valor');

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
    //     'width'=>'70px',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nombre',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'fecha_fundacion',
        'label'=>'Fecha Fundación',
        'filter' => '',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'link_logotipo',
        'filter' => '',
        'label' => 'Logotipo',
        'format' => 'html',
        'width' => '100px',
        'value' => function ($data) {
            return Html::img($data->link_logotipo, ['width' => '200px']);
        }
    ],
    [
        'class' => '\kartik\grid\BooleanColumn',
        'attribute' => 'activo',
        'label' => 'Estado',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_genero',
        'label' => 'Género',
        'format'=>'raw',
        'filter' => $arrayCatalogos,
        'value' => function ($model) {
            return ($model->id_genero)?'<span style="color:green"><b>'.$model->genero->valor.'</scan>':'';
        }
    ], 
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_categoria',  
        'label'=>'Categoría', 
        'format'=>'raw',
        'filter' => $arrayCategoria,     
        'value' => function ($data) {
            return ($data->id_categoria)?'<span style="color:blue"><b>'.$data->categoria->valor.'</scan>':'';
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_campeonato',
        'label'=>'Campeonato',
        'value' => function ($data) {
            return ($data->id_campeonato)?$data->campeonato->nombre:'';
        }
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'template' => '{view} {update} {delete} {custom}',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => 'Delete',
            'data-confirm' => false,
            'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Eliminar',
            'data-confirm-message' => 'Esta seguro que desea eliminar ?'
        ],
        'buttons' => [
            'custom' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-cogs"></i>', ['modal-contenido', 'id' => $key], [
                    'role' => 'modal-remote',
                    'title' => 'Custom Action',
                    'data-toggle' => 'tooltip',
                    'class' => 'btn btn-info btn-sm',
                ]);
            },
        ],
    ],

];
