<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset; 
use hoaaah\ajaxcrud\BulkButtonWidget;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use execut\widget\TreeView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<div class="menu-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role' => 'modal-remote', 'title' => 'Crear Nuevo', 'class' => 'btn btn-default']) .
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Recargar Grid']) .
                    '{toggleData}'.
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i>Lista del Menú',
                'before'=>'<em>* Cambie el tamaño de las columnas de la tabla como si fuera una hoja de cálculo arrastrando los bordes de las columnas</em>',
//                'after'=>BulkButtonWidget::widget([
//                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar Todo',
//                                ["bulkdelete"] ,
//                                [
//                                    "class"=>"btn btn-danger btn-xs",
//                                    'role'=>'modal-remote-bulk',
//                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                                    'data-request-method'=>'post',
//                                    'data-confirm-title'=>'Eliminación',
//                                    'data-confirm-message'=>'¿Está seguro de eliminar el registro?'
//                                ]),
//                        ]).
//                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<!---->
<!---->
<!--<div class="row">-->
<!--    <div class="col-lg-8">-->
<!--        <div class="menu-index">-->
<!--            --><?php //// echo $this->render('_search', ['model' => $searchModel]);   ?>
<!---->
<!--            <p>-->
<!--                --><?php //= Html::a(Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
<!--            </p>-->
<!---->
<!--            --><?php //Pjax::begin(); ?>
<!--            --><?php //=
//            GridView::widget([
//                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
//                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
//                    [
//                        'attribute' => 'icono',
//                        'filter' => '',
//                        'label' => Yii::t('rbac-admin', 'Icon'),
//                        'format' => 'raw',
//                        'value' => function($model) {
//                            return ($model->icon) ? rmrevin\yii\fontawesome\FA::icon($model->icon) : '';
//                        }
//                    ],
//                    'name',
//                    [
//                        'attribute' => 'menuParent.name',
//                        'filter' => Html::activeTextInput($searchModel, 'parent_name', [
//                            'class' => 'form-control', 'id' => null
//                        ]),
//                        'label' => Yii::t('rbac-admin', 'Parent'),
//                    ],
//                    'route',
//                    'order',
//                    ['class' => 'yii\grid\ActionColumn'],
//                ],
//            ]);
//            ?>
<!--            --><?php //Pjax::end(); ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-4" style="background-color: white; min-height: 500px;">-->
<!--        --><?php
//        $JSEventClick = <<<EOF
//            function (undefined, item) {
//                if (item.href !== location.pathname) {
//                        $(location).attr('href',item.href);
//                }
//            }
//        EOF;
//        $groupsContent = TreeView::widget([
//            'data' => common\models\Menu::getArbolMenu(),
//            'size' => TreeView::SIZE_NORMAL,
//            'header' => 'Menu Actual',
//            'searchOptions' => [
//                'inputOptions' => [
//                    'placeholder' => 'Buscar menu...'
//                ],
//            ],
//            'clientOptions' => [
//                'onNodeSelected' => new JsExpression($JSEventClick),
//            ],
//        ]);
//
//        echo $groupsContent;
//        ?>
<!--    </div>-->
<!--</div>-->
