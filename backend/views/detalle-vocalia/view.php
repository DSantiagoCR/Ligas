<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DetalleVocalia */
?>
<div class="detalle-vocalia-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cabecera_vocalia',
            'ta',
            'tr',
            'goles',
            'entrega_carnet:boolean',
            'id_jugador',
        ],
    ]) ?>

</div>
