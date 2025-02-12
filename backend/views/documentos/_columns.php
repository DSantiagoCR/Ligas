<?php

use Codeception\PHPUnit\ResultPrinter\HTML as ResultPrinterHTML;
use common\models\Campeonato;
use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$modelCampeonato = Campeonato::find()->where(['estado'=>true])->all();
$arrayCampeonato = ArrayHelper::map($modelCampeonato,'id','nombre');
$modelsCatalogo = Catalogos::find()->where(['id_catalogo'=>25])->all();
$arrayCatalogo = ArrayHelper::map($modelsCatalogo,'id','valor');

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
        'attribute'=>'id_campeonato',
        'label'=>'Campeonato',
        'filter'=>$arrayCampeonato,
        'value'=>function($model)
            {
                return $model->campeonato->nombre . " / ".$model->campeonato->anio;
            }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_tipo_documento',
        'filter'=>$arrayCatalogo,
        'label'=>'Tipo Documento',
        'value'=>function($model)
            {
                return $model->tipoDocumento->valor;
            }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'link',
        'format' => 'html',
        'value' => function ($data) {
            //return HTML::img( $data->link, ['width' => '300px']);
            return Html::a(substr($data->link,0,50).'...', $data->link, ['target' => '_blank','rel' => 'noopener noreferrer']);

        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'descripcion',
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