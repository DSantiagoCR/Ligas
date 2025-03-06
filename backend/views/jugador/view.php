<?php

use common\models\Util\HelperGeneral;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
?>
<div class="jugador-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'code',
            [
                'label'=>'Foto',
                'format'=>'raw',                
                'value' => function ($data) {                  
                    // Obtener la URL accesible desde el navegador
                    $pathWeb = Url::base(true)  . $data->link_foto;
                    $pathWeb = str_replace('/administrator', '', $pathWeb); 

            
                    //Retornar la imagen con tamaño ajustado
                    //return Html::img($pathWeb, ['width' => '60px', 'height' => '60px']);  
                    return Html::a(
                        Html::img($pathWeb, ['width' => '60px', 'height' => '60px']),
                        $pathWeb, // URL destino
                        ['target' => '_blank'] // Abre en una nueva pestaña
                    );  
                                   
                }
            ],
            'nombres',
            'apellidos',
            //'fecha_nacimiento',
            [
                'label'=>'Fecha Nacimiento',
                'format'=>'raw',
                'value'=>function($data){                   
                    $aniosJugador =  HelperGeneral::calcularEdadCompleta($data->fecha_nacimiento);
                    $aniosJugador = '<scan style="color:green"><b>('.$aniosJugador.')</b></scan>';
                    return ($data->fecha_nacimiento)?($data->fecha_nacimiento.' '.$aniosJugador.''):'';               
                }
            ],
            // 'cedula',
            [
                'label'=>'Cédula',                
                'value'=>function($data){                   
                    return $data->cedula;            
                }
            ],
            'celular',
            //'id_estado_civil',
            [
                'label'=>'Estado Civil',
                'value'=>function($data){                   
                    return ($data->id_estado_civil)?$data->estadoCivil->valor:'';                   
                }
            ],
            'hijos',
            //'estado:boolean',
            [
                'label'=>'Calificado', 
                'format'=>'html',               
                'value'=>function($data){                   
                    return ($data->estado)?'<span style="color:green"><b>SI</b></span>':'<span style="color:red"><b>NO</b></span>';                 
                }
            ],
            [
                'label'=>'Equipo',               
                'value'=>function($data){                   
                    return ($data->id_equipo)?$data->equipo->nombre:'';                 
                }
            ],
            [
                'label'=>'Categoria', 
                'format'=>'raw',              
                'value'=>function($data){                   
                    return ($data->id_equipo)?'<span style="color:blue"><b>'.$data->equipo->categoria->valor.'</scan>':'';                 
                }
            ],
            [
                'label'=>'Género',
                'format'=>'raw',               
                'value'=>function($data){                   
                    return ($data->id_equipo)?'<span style="color:green"><b>'.$data->equipo->genero->valor.'</scan>':'';                 
                }
            ],
            
        ],
    ]) ?>

</div>
