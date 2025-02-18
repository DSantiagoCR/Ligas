<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CabeceraVocalia */
?>
<div class="cabecera-vocalia-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_campeonato',
            'ta_e1',
            'ta_e2',
            'tr_e1',
            'tr_e2',
            'informe_vocal',
            'informe_veedor',
            'id_arbitro',
            'informe_arbitro',
            'novedades_equipo_1',
            'novedades_equipo_2',
            'novedades_generales',
            'novedades_directiva',
            'id_estado_vocalia',
            'link_documento',
            'hora_empieza',
            'hora_termina',
            'id_equipo_1',
            'id_equipo_2',
            'id_equipo_vocal',
            'id_equipo_veedor',
            'id_cab_fecha',
        ],
    ]) ?>

</div>
