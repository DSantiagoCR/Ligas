<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\Pjax;


?>
<style>
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
            <div class="col-2 text-center border bg-secondary text-dark"><b>Gol</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b>T.A</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b>T.R</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b calss="text-center" style="font-size:10px">Carnet</b></div>

        </div>
        <?php
        $cont = 1;
        foreach ($modelDetVocalia as $model) {
            if ($model->entrega_carnet) { ?>
                <div class="row">
                    <div class="col-1 border bg-secondary text-dark" style="font-size:10px;"><b><?= $cont ?></b></div>
                    <div class="col-1 border"><?= ($model->jugador->num_camiseta) ? $model->jugador->num_camiseta : '' ?></div>
                    <div class="col-4 border"><?= $model->jugador->nombres . ' ' . $model->jugador->apellidos ?></div>
                    <div class="col-2 text-center border">
                        <?= Html::input('number', 'contador', $model->goles, [
                            'id' => 'contador-input',
                            'class' => 'text-center border-transparent',
                            'style' => 'width: 80px; font-size: 16px;',
                            'min' => 0, // Valor mínimo permitido
                            'max' => 100, // Valor máximo permitido
                        ]) ?>
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
<?php
$this->registerJs("
    $(document).ready(function() {
        $('#contador-input').on('change', function() {
            let valor = $(this).val();
            let id = $(this).data('id');
            
            $.ajax({
                url: '" . Url::to(['detalle-vocalia-f/actualiza-goles']) . "',
                type: 'POST',
                data: { id: id, valor: valor }, // Enviamos id y valor
                success: function(response) {
                    console.log('Valor actualizado correctamente:', response);
                },
                error: function() {
                    console.log('Error al actualizar el valor');
                }
            });
        });
    });
");
?>