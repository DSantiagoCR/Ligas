<?php


use common\models\Catalogos;
use yii\helpers\Url;
use yii\helpers\Html;


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
    //     'attribute'=>'id_cabecera_fecha',
        
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_grupo',
        'label'=>'Etapa',
        'value'=>function($data)
        {
            return $data->grupo->catalogo->valor;
        }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',       
        'label'=>'Grupo',
        'value'=>function($data)
        {
            return $data->grupo->nombre;
        }
    ],
  
    [
        'class'=>'\kartik\grid\DataColumn',       
        'label'=>'Categoría',
        'value'=>function($data)
        {
            return $data->grupo->categoria->valor;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',       
        'label'=>'Género',
        'value'=>function($data)
        {
            return $data->grupo->genero->valor;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_grupo_equipo1',
        'label'=>'Equipo 1',
        'filter'=>'',
        'value'=>function($data){
            return $data->grupoEquipo1->equipo->nombre;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Logo 1',
        'format'=>'html',      
        'value'=>function($data){
            $iconoBandera = "";         
            if ($data->ganador1 == 1)
            {
                $iconoBandera = '<br>'.'<i class="fas fa-flag" style="color:green"></i>';
            }
            if ($data->ganador1 == 2)
            {
                $iconoBandera = '<br><i class="fas fa-flag" style="color:orange"></i>';
            }
        
            
            return HTML::img($data->grupoEquipo1->equipo->link_logotipo, ['width' => '40px',]).$iconoBandera;
           
          
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'goles_equipo1',
        'label'=>'Goles Equipo 1',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_grupo_equipo2',
        'label'=>'Equipo 2',
        'filter'=>'',
        'value'=>function($data){
            return $data->grupoEquipo2->equipo->nombre;
        }
    ],
  
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Logo 2',
        'format'=>'html',      
        'value'=>function($data){
            $iconoBandera = "";         
            if ($data->ganador2 == 1)
            {
                $iconoBandera = '<br><i class="fas fa-flag" style="color:green"></i>';
            }
            if ($data->ganador2 == 2)
            {
                $iconoBandera = '<br><i class="fas fa-flag" style="color:orange"></i>';
            }
            return HTML::img($data->grupoEquipo2->equipo->link_logotipo, ['width' => '40px']).$iconoBandera;
          
        }
    ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'link_logotipo',
    //     'filter' => '',
    //     'label' => 'Logotipo',
    //     'format' => 'html',
    //     'width' => '100px',
    //     'value' => function ($data) {
    //         return HTML::img($data->link_logotipo, ['width' => '200px']);
    //     }
    // ],
  
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'goles_equipo2',
        'label'=>'Goles Equipo 2',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hora_inicio',
        'value'=>function($data){
            $modelCat = Catalogos::find()->where(['id'=>$data->hora_inicio])->one();
            return ($modelCat)?$modelCat->valor:'';
        }


    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_estado_partido',
        'label'=>'Estado Patido',
        'filter'=>'',
        'value'=>function($data){
            return $data->estadoPartido->valor;
        }

    ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'estado',
        'label'=>'Estado Registro',
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