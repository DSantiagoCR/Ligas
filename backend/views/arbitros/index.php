<?php

use common\models\Campeonato;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ArbitrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arbitros';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
$modelCampeonato = Campeonato::find()->where(['estado' => true])->one();
?>
<div class="arbitros-index">
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
                                ['create'],
                                ['role' => 'modal-remote', 'title' => 'Create new Arbitros', 'class' => 'btn btn-default']
                            ) .
                                Html::a(
                                    '<i class="glyphicon glyphicon-repeat"></i>',
                                    [''],
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
                        'heading' => '<i class="glyphicon glyphicon-list"></i> Arbitros ',
                        'before' => '',
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
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "size" => Modal::SIZE_EXTRA_LARGE
]) ?>
<?php Modal::end(); ?>