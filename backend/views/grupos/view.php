<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Grupos */
?>
<div class="grupos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'nombre',
        ],
    ]) ?>

</div>
