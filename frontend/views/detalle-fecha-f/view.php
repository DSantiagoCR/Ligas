<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DetalleFecha */
?>
<div class="detalle-fecha-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cabecera_fecha',
            'id_grupo',
            'id_grupo_equipo1',
            'id_grupo_equipo2',
            'goles_equipo1',
            'goles_equipo2',
            'hora_inicio',
            'id_estado_partido',
            'estado:boolean',
            'id_etapa',
        ],
    ]) ?>

</div>
