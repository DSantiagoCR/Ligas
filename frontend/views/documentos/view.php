<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\documentos */
?>
<div class="documentos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_campeonato',
            'id_tipo_documento',
            'link',
            'nombre',
            'descripcion',
        ],
    ]) ?>

</div>
