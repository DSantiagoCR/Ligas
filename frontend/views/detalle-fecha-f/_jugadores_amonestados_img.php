<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\Pjax;

//java scrip para cambiar el check de entrega carnet
$this->registerJs(new JsExpression("
    $(document).on('change', '.ajax-checkbox', function() {
        var id = $(this).data('id'); // ID del registro
        var estado = $(this).is(':checked') ? 1 : 0; // Estado del checkbox

        $.ajax({
            url: '" . Url::to(['detalle-fecha-f/entrega-carnet']) . "',
            type: 'POST',
            data: {id: id, estado: estado},
            success: function(response) {
                if (response.success) {
                    console.log('Estado cambiado con éxito.');
                    location.reload();
                } else {
                    alert('Error al cambiar el estado.');
                }
            },
            error: function() {
                alert('Error en la petición AJAX.');
            }
        });
    });
"));
?>

<style>
    .btn-xs {
        /* Clase personalizada para botones más pequeños */
        padding: 2px 5px;
        font-size: 8px;
        line-height: 1;
    }

    .text-xs {
        /* Clase personalizada para botones más pequeños */
        font-size: 10px;
    }

    .carnet-img {
        border-radius: 10px;
        /* Bordes redondeados */
        border: 2px solid #ddd;
        /* Borde sutil */
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
        /* Sombra ligera */
        object-fit: cover;
        /* Asegura que la imagen se vea bien */
        
    }
</style>
<?php Pjax::begin() ?>


<div id="collapse<?= $tipo ?>" class="accordion-collapse collapse show">
    <div class="accordion-body">
        <div class="row">
            <?php
            $cont = 1;
            foreach ($modelDetVocalia as $model) {
               

            ?>
                    <div class="col border border-secondary bg-success p-2">
                        <div class="text-center bg-danger p-0" >#<?= ($model->jugador->num_camiseta) ? $model->jugador->num_camiseta : '' ?></div>
                        <br>
                        <div class="row ">
                           
                            <div class="col text-center">
                                <?php
                                //$pathWeb = Url::base(true)  . $data->link_logotipo;
                                $pathWeb = Yii::getAlias('@web')  . $model->jugador->link_foto;
                                ?>
                                <?= Html::img($pathWeb, [
                                    'width' => '150px',
                                    'height' => '150px',
                                    'class' => 'carnet-img border border-warning shadow', // O 'rounded-circle' para hacerlo circular
                                    'alt' => 'Logotipo',
                                    //'onclick' => 'mostrarMensaje()'
                                ]); ?>
                                <br>
                                <div class="rounded-pill bg-white text-black p-1"><?= substr($model->jugador->nombres . ' ' . $model->jugador->apellidos, 0, 20) ?></div>
                            </div>
                        </div>
                        <div class="text-center bg-gray p-0" ><?= $cont?></div>

                    </div>

            <?php
                    $cont = $cont + 1;
                    $i = $i + 1;
                
            } ?>
        </div>
    </div>
</div>

<?php Pjax::end() ?>
<script>
    function mostrarMensaje() {
        alert("¡Imagen clickeada!");
    }
</script>