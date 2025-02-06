<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserEquipo */
?>
<div class="user-equipo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_equipo',
            'id_user',
            'estado',
        ],
    ]) ?>

</div>
