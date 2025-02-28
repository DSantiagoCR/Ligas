<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CabeceraVocalia */
?>
<div class="cabecera-vocalia-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'id_cab_fecha',
            [
                'attribute' => 'id_cab_fecha',
                'label' => 'Fecha Calendario',
                'format' => 'html',
                'value' => function ($model) {
                    return ($model->id_cab_fecha) ? $model->cabFecha->dia . '<br>' .
                        '<span style="color:blue; font-size:12px">' . $model->cabFecha->fecha . '</span>' : '';
                }
            ],
            // 'id_campeonato',
            [
                'attribute' => 'id_campeonato',
                'label' => 'Campeonato',
                'value' => function ($model) {
                    return $model->campeonato->nombre;
                }
            ],
            // 'id_equipo_1',
            [
                'attribute' => 'id_equipo_1',
                'label' => 'Equipo 1',
                'value' => function ($model) {
                    // return \yii\helpers\Html::a('Ver Equipo', ['equipo/view', 'id'=>$model->id]);
                    return $model->equipo1->nombre;
                }
            ],
            'ta_e1',
            'ta_e2',
            //'id_equipo_2',
            [
                'attribute' => 'id_equipo_1',
                'label' => 'Equipo 2',
                'value' => function ($model) {
                    // return \yii\helpers\Html::a('Ver Equipo', ['equipo/view', 'id'=>$model->id]);
                    return $model->equipo2->nombre;
                }
            ],
            'tr_e1',
            'tr_e2',

            'informe_vocal',
            'informe_veedor',
            // 'id_arbitro',
            [
                'attribute' => 'id_arbitro',
                'label' => 'Arbitro',
                'value' => function ($model) {
                    // return \yii\helpers\Html::a('Ver Equipo', ['equipo/view', 'id'=>$model->id]);
                    return ($model->id_arbitro) ? $model->arbitro->nombre : '';
                }

            ],
            'informe_arbitro',
            'novedades_equipo_1',
            'novedades_equipo_2',
            'novedades_generales',
            'novedades_directiva',
            // 'id_estado_vocalia',
            [
                'attribute' => 'id_estado_vocalia',
                'label' => 'Estado Vocalia',
                'value' => function ($model) {
                    return $model->estadoVocalia->valor;
                }
            ],
            'link_documento',
            'hora_empieza',
            'hora_termina',

            // 'id_equipo_vocal',
            // 'id_equipo_veedor',
            [
                'attribute' => 'id_equipo_vocal',
                'label' => 'Vocal',
                'value' => function ($model) {
                    return ($model->id_equipo_vocal) ? $model->equipoVocal->nombre : '';
                }
            ],
            [
                'attribute' => 'id_equipo_veedor',
                'label' => 'Veedor',
                'value' => function ($model) {
                    return ($model->id_equipo_veedor) ? $model->equipoVeedor->nombre : '';
                }
            ],

        ],
    ]) ?>

</div>