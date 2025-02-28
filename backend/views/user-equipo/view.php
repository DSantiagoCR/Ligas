<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserEquipo */
?>
<div class="user-equipo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'id_equipo',
            [
                'attribute' => 'id_equipo',
                'label' => 'Equipo',
                'value' => function ($model) {
                    // return \yii\helpers\Html::a('Ver Equipo', ['equipo/view', 'id'=>$model->id]);
                    return $model->equipo->nombre;
                }
            ],
            // 'id_user',
            [
                'attribute' => 'id_user',
                'label' => 'Usuario',
                'value' => function ($model) {
                    // return \yii\helpers\Html::a('Ver Equipo', ['equipo/view', 'id'=>$model->id]);
                    return $model->user->username;
                }
            ],
            // 'estado',
            [
                'attribute' => 'estado',
                'label' => 'Estado',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->estado 
                        ? '<span class="badge bg-success">Activo</span>' 
                        : '<span class="badge bg-danger">Inactivo</span>';
                },
            ],
            
            
        ],
    ]) ?>

</div>
