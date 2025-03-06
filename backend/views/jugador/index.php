<?php

use common\models\Campeonato;
use common\models\Equipo;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\JugadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jugadores';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
$modelEquipo = Equipo::findOne($id_equipo);
$modelCampeonato = Campeonato::find()->where(['estado' => true])->one();
?>


<div class="equipo-index">
    <div class="card">
        <div class="card-body">
            <div class="jugador-index">
                <div id="ajaxCrudDatatable">
                    <?= GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'pjax' => true,
                        'columns' => require(__DIR__ . '/_columns.php'),
                        'toolbar' => [
                            [
                                'content' =>
                                Html::a(
                                    '<i class="glyphicon glyphicon-plus"></i>',
                                    ['create'],
                                    ['role' => 'modal-remote', 'title' => 'Crear Jugador', 'class' => 'btn btn-default']
                                ) .
                                    Html::a(
                                        '<i class="glyphicon glyphicon-repeat"></i>',
                                        ['','id_equipo'=>$id_equipo],
                                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Actualizar']
                                    ) .
                                    '{toggleData}' .
                                    '{export}'
                            ],
                        ],
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'type' => 'primary',
                            'heading' => '<i class="glyphicon glyphicon-list"></i> Jugadores Club '.' '.$modelEquipo->nombre. ' ('.$modelEquipo->categoria->valor.')'. ' ('.$modelEquipo->genero->valor.')',
                            'before' => '<img style="width:30px" src="'.$modelEquipo->link_logotipo.'" />',
                            // 'after' => BulkButtonWidget::widget([
                            //     'buttons' => Html::a(
                            //         '<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                            //         ["bulkdelete"],
                            //         [
                            //             "class" => "btn btn-danger btn-xs",
                            //             'role' => 'modal-remote-bulk',
                            //             'data-confirm' => false,
                            //             'data-method' => false, // for overide yii data api
                            //             'data-request-method' => 'post',
                            //             'data-confirm-title' => 'Are you sure?',
                            //             'data-confirm-message' => 'Are you sure want to delete this item'
                            //         ]
                            //     ),
                            // ]) .
                            //     '<div class="clearfix"></div>',
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "size"=>Modal::SIZE_EXTRA_LARGE
]) ?>
<?php Modal::end(); ?>