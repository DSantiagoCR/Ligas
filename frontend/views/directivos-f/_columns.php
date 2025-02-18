<?php
use yii\helpers\Url;
use common\models\Equipo;
use common\models\Campeonato;
use common\models\Catalogos;
use yii\helpers\ArrayHelper;
$modelEquipos = Equipo::find()->all();
$arrayEquipos = ArrayHelper::map($modelEquipos, 'id', function($data)
{
    return $data->nombre.' - '. $data->genero->valor . ' - '.$data->categoria->valor;
});

$modelListTipoDirectivos = Catalogos::find()->where(['id_catalogo' => 1])->andWhere(['estado' => true])->all();
$arrayDirectivo = ArrayHelper::map($modelListTipoDirectivos, 'id', 'valor');

$modelCampeonato = Campeonato::find()->where(['estado' => 1])->one();


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
        'attribute'=>'nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'apellido',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_nacimiento',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cedula',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_estado_civil',
    // ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'estado',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_equipo',
        'label'=>'Equipos',
        'filter'=>$arrayEquipos,
        'value'=>function($data)
        {
            return $data->equipo->nombre.' - '. $data->equipo->genero->valor . ' - '.$data->equipo->categoria->valor;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        //'attribute'=>'id_equipo',
        'label'=>'Categoria',
        'filter'=>$arrayEquipos,
        'value'=>function($data)
        {
            return $data->equipo->genero->valor . ' - '.$data->equipo->categoria->valor;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_tipo_directivo',
        'label' => 'Cargo',
        'filter' => $arrayDirectivo,
        'value' => function ($model) {
            return ($model->id_tipo_directivo) ? $model->tipoDirectivo->valor : '';
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_campeonato',
        'label' => 'Campeonato',
        'format' => 'html',
        'value' => function ($model) {
            return ($model->id_campeonato) ? '<span style="color:red"><b>' . $model->campeonato->nombre . '</b></span>' : '';
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_tipo_directivo',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_campeonato',
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
                          'data-confirm-title'=>'Eliminar?',
                          'data-confirm-message'=>'Esta seguro de eliminar el registro ?'], 
    ],

];   