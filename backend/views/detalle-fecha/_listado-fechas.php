<?php

use yii\helpers\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CabinImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<div class="cabin-image-detail-by-cabin">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                [
                    'content' =>
                    Html::a(
                        '<i class="glyphicon glyphicon-plus"></i>',
                        ['create', 'id_cabFechas' => $id_cabFechas],
                        ['role' => 'modal-remote', 'title' => 'Agregar Equipo', 'class' => 'btn btn-default']
                    )
                    //    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    //        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    //    '{toggleData}'.
                    //    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="fa fa-address-book"></i> Detalle Fechas',
                'before' => '<em>* Cambie el tamaño de las columnas de la tabla como si fuera una hoja de cálculo arrastrando los bordes de las columnas.</em>',

            ]
        ]) ?>
    </div>


    <?php Modal::begin([
        "id" => "ajaxCrudModal",
        "footer" => "", // always need it for jquery plugin
        'size' => Modal::SIZE_EXTRA_LARGE,
    ]) ?>
    <?php Modal::end(); ?>
    <script>
        $(document).ready(function() {
            $('div .modal-header').html('<button type="button" class="close" data-bs-dismiss="modal"></button>');
        });
    </script>