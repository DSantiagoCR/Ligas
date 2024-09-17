<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
?>
<div class="menu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'parent',
            'route',
            'order',
            'data',
            'icon',
            'option',
            'estado',
        ],
    ]) ?>

</div>
