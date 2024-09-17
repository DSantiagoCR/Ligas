<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Parametros */
?>
<div class="parametros-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'nombre',
            'valor1',
            'valor2',
            'valor3',
            'valor4',
        ],
    ]) ?>

</div>
