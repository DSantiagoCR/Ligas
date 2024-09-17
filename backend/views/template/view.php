<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Template */
?>
<div class="template-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'cuerpo:ntext',
        ],
    ]) ?>

</div>
