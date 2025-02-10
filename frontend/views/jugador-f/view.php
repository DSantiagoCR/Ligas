<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Jugador */
?>
<div class="jugador-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'nombres',
            'apellidos',
            'fecha_nacimiento',
            'cedula',
            'celular',
            'id_estado_civil',
            'hijos',
            'estado:boolean',
            'link_foto',
            'id_equipo',
            'puede_jugar:boolean',
            'ta_acumulada',
            'ta_actuales',
            'tr_acumulada',
            'tr_actuales',
            'goles',
            'link_ficha',
        ],
    ]) ?>

</div>
