<?php

use Codeception\PHPUnit\ResultPrinter\HTML as ResultPrinterHTML;
use common\models\Util\HelperGeneral;
use yii\helpers\Url;
use yii\helpers\Html;

$arrayEstadoVocalia = HelperGeneral::devuelveEstadoVocalia();
$arrayDiasHabiles = HelperGeneral::devuelveDiasHabiles();
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
    //     'attribute'=>'id_campeonato',
    //     'label'=>'Campeonato',
    //     'value' => function($model) {   
    //         return $model->campeonato->nombre;
    //     }
    // ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_cab_fecha',
        'label'=>'Fecha Calendario',
        'filter'=>$arrayDiasHabiles,
        'format'=>'html',
        'value'=>function($model){
            return ($model->id_cab_fecha)?$model->cabFecha->dia.'<br>'.
            '<span style="color:blue; font-size:12px">'.$model->cabFecha->fecha.'</span>':'';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',   
        'label'=>'Fecha Número ',
        'format'=>'html',
        'value'=>function($model){
            $num = ($model->id_cab_fecha)?$model->cabFecha->num_fecha:"";
            return '<div style="font-size:15px;" class="text-center text-red text-bold">'.$num.'</div>';
        }
    ],
    [        
        'label'=>'Hora',
        'format'=>'html',
        'value'=>function($model){
            return ($model->id_det_fecha)?$model->detFecha->horaInicio->valor:'';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_equipo_1',
        'label'=>'Equipo 1',
        'format'=>'html',
        'contentOptions'=>['style'=>'text-align: center; vertical-align: middle;'],
        'value'=>function($model){
            // return \yii\helpers\Html::a('Ver Equipo', ['equipo/view', 'id'=>$model->id]);
            return  HTML::img($model->equipo1->link_logotipo, ['width' => '40px',]).'<br>'.
            $model->equipo1->nombre;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ta_e1',
        'label'=>'T.A E1',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tr_e1',
        'label'=>'T.R E1',

    ],   
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_equipo_2',
        'label'=>'Equipo 2',
        'format'=>'html',
        'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
        'value'=>function($model){
            return  HTML::img($model->equipo2->link_logotipo, ['width' => '40px',]).'<br>'. $model->equipo2->nombre;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ta_e2',
        'label'=>'T.A E2'

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tr_e2',
        'label'=>'T.R E2',

    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'informe_vocal',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'informe_veedor',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_arbitro',
        'label'=>'Arbitro',
        'value'=>function($model){
            // return \yii\helpers\Html::a('Ver Equipo', ['equipo/view', 'id'=>$model->id]);
            return ($model->id_arbitro)?$model->arbitro->nombre.' '.$model->arbitro->apellido:'';
        }

    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'informe_arbitro',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'novedades_equipo_1',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'novedades_equipo_2',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'novedades_generales',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'novedades_directiva',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_estado_vocalia',
        'label'=>'Estado Vocalia',
        'filter'=>$arrayEstadoVocalia,
        'value'=>function($model)
        {
            return $model->estadoVocalia->valor;
        }
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'link_documento',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'hora_empieza',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'hora_termina',
    // ],

 
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_equipo_vocal',
        'label'=>'Vocal',
        'value'=>function($model){       
            return ($model->id_equipo_vocal)?$model->equipoVocal->nombre:'';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_equipo_veedor',
        'label'=>'Veedor',
        'value'=>function($model){         
            return ($model->id_equipo_veedor)?$model->equipoVeedor->nombre:'';
        }
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
                          'data-confirm-message'=>'Esta seguro de eliminar el registro ?'], 
    ],

];   