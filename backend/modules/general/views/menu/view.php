<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
?>
<div class="menu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'name',
            [
                'label'=>'Nombre Menú',
                'value'=>function($data)
                {
                    return $data->name;
                }
            ],
            //'parent',
            [
                'label'=>'Menú Padre',
                'value'=>function($data)
                {
                    return (isset($data->parent0->name))?$data->parent0->name:'';
                }
            ],
            //'route',
            [
                'label'=>'Ruta',
                'value'=>function($data)
                {
                    return $data->route;
                }
            ],
            //'order',
            [
                'label'=>'Num. Orden',
                'value'=>function($data)
                {
                    return $data->order;
                }
            ],
            //'data',
            //'icon',
            [
                'label'=>'Icono',
                'value'=>function($data)
                {
                    return $data->icon;
                }
            ],
            //'option',
            //'estado',
            [
              'label'=>'Estado',
              'value'=>function($data)
              {
                  return ($data->estado)?'Activado':'Desactivado';
              }
            ],
        ],
    ]) ?>

</div>
<script>
    $(document).ready(function () {
        $('div .modal-header').html(' <h5 class="modal-title">Tipo Servicio </h5>');
    });
</script>
