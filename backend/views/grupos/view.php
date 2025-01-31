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
            [
                'attribute' => 'id_catalogo',
                'label' => 'Catálogo',
                'value' => function ($data) {
                    return $data->catalogo->valor;
                }
            ],
            [
                'attribute' => 'id_categoria',
                'label' => 'Categoría',
                'value' => function ($data) {
                    return $data->categoria->valor;
                }
            ],
            [
                'attribute' => 'id_genero',
                'label' => 'Género',
                'value' => function ($data) {
                    return $data->genero->valor;
                }
            ],


        ],
    ]) ?>

</div>