<?php

use common\models\Util\HelperGeneral;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
   
?>

<div class="jugador-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'code',
             //'id_equipo',
             [
                'label'=>'Foto',
                'format'=>'raw',                
                'value' => function ($data) {                  
                    // Obtener la URL accesible desde el navegador
                    $pathWeb = Url::base(true)  . $data->link_foto;
            
                    //Retornar la imagen con tamaño ajustado
                    //return Html::img($pathWeb, ['width' => '60px', 'height' => '60px']);  
                    return Html::a(
                        Html::img($pathWeb, ['width' => '60px', 'height' => '60px']),
                        $pathWeb, // URL destino
                        ['target' => '_blank'] // Abre en una nueva pestaña
                    );  
                                   
                }
            ],            
             [
                'label'=>'Equipo',
                'value'=>function($data){                   
                    return $data->equipo->nombre;                   
                }
            ],
            'nombres',
            'apellidos',
            //'num_camiseta',
            [
                'label'=>'Número',               
                'value'=>function($data){     
                    return ($data->num_camiseta)?($data->num_camiseta):'';               
                }
            ],
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
            //'cedula',
            [
                'label'=>'Cédula',
                'value'=>function($data){                   
                    return $data->cedula   ;                  
                }
            ],
            'celular',
            // 'id_estado_civil',
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
                'format'=>'raw',
                'value'=>function($data)
                {
                    return $data->estado?'<scan style="color:green"><b>SI</b></scan>':'<scan style="color:red"><b>NO</b></scan>';
                }
            ],
           // 'link_foto',
           
            // 'puede_jugar:boolean',
            [
                'label'=>'Puede Jugar',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->puede_jugar?'<scan style="color:green"><b>SI</b></scan>':'<scan style="color:red"><b>NO</b></scan>';                
                }
            ],
            // 'ta_acumulada',
            [
                'label'=>'T.A Acumulada',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->ta_acumulada;              
                }
            ],
            //'ta_actuales',
            [
                'label'=>'T.A Actuales',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->ta_actuales;              
                }
            ],
            //'tr_acumulada',
            [
                'label'=>'T.R Acumulada',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->tr_acumulada;              
                }
            ],
            //'tr_actuales',
            [
                'label'=>'T.R Actuales',
                'format'=>'raw',
                'value'=>function($data){                   
                    return $data->tr_actuales;              
                }
            ],
            //'goles',
            [
                'label'=>'Goles',
                'value'=>function($data){                   
                    return ($data->goles)?$data->goles:'0';                   
                }
            ],
            //'link_ficha',
        ],
    ]) ?>

</div>
<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Vista Previa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid rounded" alt="Imagen">
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            let imageUrl = this.querySelector('img').getAttribute('data-img');
            document.getElementById('modalImage').setAttribute('src', imageUrl);
        });
    });
});

</script>