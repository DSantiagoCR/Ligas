<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;
use common\models\Util\HelperGeneral;
use frontend\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DirectivosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Directivos';
// $this->params['breadcrumbs'][] = $this->title;
$modelCampeonato = HelperGeneral::devuelveCampeonatoActual();
CrudAsset::register($this);
AppAsset::register($this);
?>
<div class="directivos-index">

    <div class="row">
        <div class="col-2">
            <?= $this->render('/principal/index', ['modelUE' => $modelUE, 'submenu' => null]) ?>
        </div>
        <div class="col">
            <div class="card">           
                <div class="card-body">
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
                                        ['create', 'id_equipo' => $modelUE->id],
                                        ['role' => 'modal-remote', 'title' => 'Create new Directivos', 'class' => 'btn btn-default']
                                    ) .
                                        Html::a(
                                            '<i class="glyphicon glyphicon-repeat"></i>',
                                            ['', 'id' => $modelUE->id],
                                            ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Reset Grid']
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
                                'heading' => '<i class="glyphicon glyphicon-list"></i> Lista Directivos ' . $modelUE->equipo->nombre,
                                'before' => '<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                                // 'after'=>BulkButtonWidget::widget([
                                //             'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                //                 ["bulkdelete"] ,
                                //                 [
                                //                     "class"=>"btn btn-danger btn-xs",
                                //                     'role'=>'modal-remote-bulk',
                                //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                //                     'data-request-method'=>'post',
                                //                     'data-confirm-title'=>'Eliminar',
                                //                     'data-confirm-message'=>'Esta seguro de eliminar el registro ?'
                                //                 ]),
                                //         ]).                        
                                //         '<div class="clearfix"></div>',
                            ]
                        ]) ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "size" => Modal::SIZE_LARGE
]) ?>
<?php Modal::end(); ?>