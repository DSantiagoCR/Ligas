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
        <?php
        $cont = 1;
        foreach ($modelDetVocalia as $model) {
            // if (!$model->entrega_carnet) {
            if ($model->entrega_carnet) {

        ?>
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col">

                    </div>


                    <div class="col-1 border"><?= ($model->jugador->num_camiseta) ? $model->jugador->num_camiseta : '' ?></div>

                    <div class="col-2 text-center border"><?= $model->goles ?></div>
                    <div class="col-2">
                        <?php
                        //$pathWeb = Url::base(true)  . $data->link_logotipo;
                        $pathWeb = Yii::getAlias('@web')  . $model->jugador->link_foto;
                        ?>
                        <?= $model->jugador->nombres.' '.$model->jugador->apellidos?>
                        <?= Html::img($pathWeb, [
                            'width' => '100px',
                            'height' => '100px',
                            'class' => 'carnet-img', // O 'rounded-circle' para hacerlo circular
                            'alt' => 'Logotipo',
                            'onclick' => 'mostrarMensaje()'
                        ]); ?>
                        <br>
                        
                        <?= ($model->jugador->num_camiseta) ? $model->jugador->num_camiseta : '' ?>

                    </div>

                </div>
        <?php
                $cont = $cont + 1;
                $i = $i + 1;
            }
        } ?>

    </div>
</div>

<?php Pjax::end() ?>
<script>
    function mostrarMensaje() {
        alert("¡Imagen clickeada!");
    }
</script>