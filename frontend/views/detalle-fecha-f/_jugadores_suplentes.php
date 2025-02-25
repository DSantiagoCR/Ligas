<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\Pjax;

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
</style>
<?php Pjax::begin() ?>


<div id="collapse<?= $tipo ?>" class="accordion-collapse collapse show">
    <div class="accordion-body">
        <div class="row text-center">
            <div class="col-1 border bg-secondary text-dark"><b>#.</b></div>
            <div class="col-1 border bg-secondary text-dark"><b>No.</b></div>
            <div class="col-4 border bg-secondary text-dark"><b>Jugador</b></div>
            <div class="col-3 text-center border bg-secondary text-dark"><b>Gol</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b>T.A</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b>T.R</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b calss="text-center" style="font-size:10px">Carnet</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b calss="text-center" style="font-size:10px">Cambio X</b></div>



        </div>
        <?php
        $cont = 1;
        foreach ($modelDetVocalia as $model) {
            if (!$model->entrega_carnet) {
        ?>
                <div class="row">
                    <div class="col-1 border bg-secondary text-dark" style="font-size:10px;"><b><?= $cont ?></b></div>
                    <div class="col-1 border"><?= ($model->jugador->num_camiseta) ? $model->jugador->num_camiseta : '' ?></div>
                    <div class="col-4 border text-xs"><?= $model->jugador->nombres . ' ' . $model->jugador->apellidos ?></div>
                    <div class="col-3 text-center border">
                        <div class="d-flex align-items-center ">
                            <?= Html::button('−', ['class' => 'btn btn-danger btn-sm px-2 py-0', 'id' => 'decrement']) ?>
                            <?= Html::input('number', 'counter', 0, [
                                'id' => 'counter',
                                'class' => 'form-control text-center mx-1 btn-xs',
                                'style' => 'width: 60px; height: 30px; font-size: 14px',
                                'disabled' => true,
                                'min' => 1
                            ]) ?>
                            <?= Html::button('+', ['class' => 'btn btn-success btn-sm px-2 py-0', 'id' => 'increment']) ?>
                        </div>
                    </div>
                    <div class="col-1 text-center border">-</div>
                    <div class="col-1 text-center border">-</div>
                    <div class="col-1 text-center border">
                        <?= Html::checkbox('estado', $model->entrega_carnet, [
                            'class' => 'ajax-checkbox',
                            'data-id' => $model->id,
                            'data-pjax' => 1
                        ]) ?>
                    </div>
                </div>
        <?php
                $cont = $cont + 1;
            }
        } ?>

    </div>
</div>

<?php Pjax::end() ?>