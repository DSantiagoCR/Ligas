<?php

use common\models\Catalogos;
use common\models\Equipo;
use common\models\EquipoCategoria;
use common\models\EquipoCategoriaJugador;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$modelsEstadoCivil = Catalogos::find()->where(['id_catalogo'=>10])->all();
$arrayEstadoCivil = ArrayHelper::map($modelsEstadoCivil,'id','valor');

$modelEquipos = Equipo::find()->where(['activo'=>1,'id_campeonato' => $modelCampeonato->id])->all();
$arrayEquipos = ArrayHelper::map($modelEquipos, 'id', function($model) {  
    return $model->nombre . ' - ' . $model->categoria->valor . ' - '. $model->genero->valor;
});

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
        'label'=>'Número',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_nacimiento',
        'filter' => \kartik\date\DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'fecha_nacimiento',
            'type' => \kartik\date\DatePicker::TYPE_INPUT,
            'options' => [
            'id' => 'fecha-nacimiento-filter', // ID único
        ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd', // Asegúrate de que coincida con el formato de tu base de datos
            ],
        ]),
        'format' => ['date', 'php:Y-m-d'], // Formato para mostrar en la tabla
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cedula',
        'label'=>'Cédula',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'celular',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_estado_civil',
        'label'=>'Estado Civil',
        'filter'=>$arrayEstadoCivil,
        'value'=>function($model)
            {
                return ($model->id_estado_civil)?$model->estadoCivil->valor:'';
            }
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'hijos',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'link_foto',
        'label'=>'Foto',
        'format'=>'html',
        'width'=>'100px',
        'value'=>function($data)
        {
            return Html::img( $data->link_foto, ['width' => '200px']);
        }

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_equipo',
        'label'=>'Equipos',
        'filter'=>$arrayEquipos,
        'value'=>function($data)
        {
            return $data->equipo->nombre . ' - '.$data->equipo->genero->valor . ' - '.$data->equipo->categoria->valor;
        }
    ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'estado',
        'label'=>'Calificado',
    ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'puede_jugar',        
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