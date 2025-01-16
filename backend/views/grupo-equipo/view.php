<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GrupoEquipo */
?>
<div class="grupo-equipo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_campeonato',
            'id_grupo',
            'id_equipo',
        ],
    ]) ?>

</div>
