<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Util\HelperGeneral;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CabeceraVocaliaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cabecera Vocalias';
$this->params['breadcrumbs'][] = $this->title;
$modelDiasHabiles = HelperGeneral::devuelveDiasHabilesObj();
CrudAsset::register($this);

?>
<div class="container-fluid bg-light p-3">
    <div class="card  p-2">
        <div class="row ">
            <div class="col">
                <h4 class="text-center">Próximas Fechas</h4>
            </div>
            <?php
            foreach ($modelDiasHabiles as $model) {
            ?>
                <div class="col">

                    <?= Html::a($model->valor, ['index', 'dia' => $model->valor], ['class' => 'btn btn-primary rounded-pill']) ?>

                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="cabecera-vocalia-index">
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
                        // Html::a(
                        //     '<i class="glyphicon glyphicon-plus"></i>',
                        //     ['create'],
                        //     ['role' => 'modal-remote', 'title' => 'Create new Cabecera Vocalias', 'class' => 'btn btn-default']
                        // ) .
                        //     Html::a(
                        //         '<i class="glyphicon glyphicon-repeat"></i>',
                        //         [''],
                        //         ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Reset Grid']
                        //     ) .
                            '{toggleData}' .
                            '{export}'
                    ],
                ],
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'type' => 'primary',
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Coordinación Vocalias',
                    'before' => '<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
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

<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "size" => Modal::SIZE_EXTRA_LARGE
]) ?>
<?php Modal::end(); ?>