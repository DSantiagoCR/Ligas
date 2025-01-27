<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GrupoEquipo */
?>
<div class="grupo-equipo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute'=>'id_campeonato',
                'label'=>'Campeonato',
                'value'=>function($data){
                    return $data->campeonato->nombre;
                }
            ],
            //'id_campeonato',
            //'id_grupo',
            [
                'attribute'=>'id_grupo',
                'label'=>'Grupo',
                'value'=>function($data){
                    return $data->grupo->nombre;
                }
            ],
            //'id_equipo',
            [
                'attribute'=>'id_equipo',
                'label'=>'Equipo',
                'value'=>function($data){
                    return $data->equipo->nombre;
                }
            ],
        ],
    ]) ?>

</div>
