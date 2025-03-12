<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\Pjax;

//java scrip para cambiar el check de entrega carnet
$this->registerJs(new JsExpression("
    $(document).on('click', '.ajax-click-suplentes', function() {
      
        var id = $(this).data('id'); // ID del registro
        var estado = 1;

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
            $cont_jug = 1;
            $num_jug_por_fila = 0;

            foreach ($modelDetVocalia as $model) {

                if (!$model->entrega_carnet) {

            ?>
                    <div class="col border border-secondary bg-success p-2">
                        <div class="text-center bg-danger p-0">#<?= ($model->jugador->num_camiseta) ? $model->jugador->num_camiseta : '' ?></div>

                        <div class="row p-2">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="rounded-pill bg-info text-xs">Goles</div>
                                    <div class=" text-bold"> <?= $model->goles ?></div>
                                </div>
                                <div class="col-8">
                                    <div class="rounded-pill bg-info text-xs">Posición</div>
                                    <div class=" text-sm"> <?= $model->jugador->posicion ?></div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <?php
                                //$pathWeb = Url::base(true)  . $data->link_logotipo;
                                $pathWeb = Yii::getAlias('@web')  . $model->jugador->link_foto;
                                ?>
                                <?= Html::img($pathWeb, [
                                    'width' => '150px',
                                    'height' => '150px',
                                    'data-id' => $model->id,
                                    'class' => 'carnet-img border border-warning shadow ajax-click-suplentes', // O 'rounded-circle' para hacerlo circular
                                    'alt' => 'Logotipo',
                                ]); ?>
                                <br>
                                <div class="rounded-pill bg-white text-black p-1"><?= substr($model->jugador->nombres . ' ' . $model->jugador->apellidos, 0, 20) ?></div>
                            </div>
                        </div>
                        <div class="text-center bg-gray p-0"><?= $cont_jug ?></div>

                    </div>

            <?php
                    $cont_jug = $cont_jug + 1;
                    $num_jug_por_fila = $num_jug_por_fila + 1;
                    $i = $i + 1;
                }
            } ?>
        </div>
    </div>
</div>

<?php Pjax::end() ?>