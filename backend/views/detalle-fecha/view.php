<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DetalleFecha */
?>
<div class="detalle-fecha-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_cabecera_fecha',
            //'id_grupo',
            [
                'label' => 'Etapa',
                'value' => function ($data) {
                    return $data->grupo->catalogo->valor;
                }
            ],
            //'id_grupo_equipo1',
            [
                'label' => 'Equipo 1',
                'value' => function ($data) {
                    return $data->grupoEquipo1->equipo->nombre;
                }
            ],
            //'goles_equipo1',
            [
                'label' => 'Goles Equipo 1',
                'value' => function ($data) {
                    return $data->goles_equipo1;
                }
            ],
            //'id_grupo_equipo2',
            [
                'label' => 'Equipo 2',
                'value' => function ($data) {
                    return $data->grupoEquipo2->equipo->nombre;
                }
            ],
            //'goles_equipo2',
            [
                'label' => 'Goles Equipo 2',
                'value' => function ($data) {
                    return $data->goles_equipo2;
                }
            ],
            'hora_inicio',

            //'id_estado_partido',
            [
                'label' => 'Estado Patido',
                'value' => function ($data) {
                    return $data->estadoPartido->valor;
                }
            ],

            //'estado:boolean',
            [
                'label' => 'Estado Registro',
                'value' => function ($data) {
                    return $data->estado?'Activado':'Desactivado';
                }
            ],
        ],
    ]) ?>

</div>