<?php

use common\models\Campeonato;
use common\models\Catalogos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Equipo */
/* @var $form yii\widgets\ActiveForm */

$modelsCatGenero = Catalogos::find()->where(['id_catalogo' => 17])->all();
$arrayCatGenero = ArrayHelper::map($modelsCatGenero, 'id', 'valor');

$modelsCatCategoria = Catalogos::find()->where(['id_catalogo' => 21])->all();
$arrayCatCategia = ArrayHelper::map($modelsCatCategoria, 'id', 'valor');

$modelsCampeonato = Campeonato::find()->where(['estado' => true])->one();
$modelsCampeonatoALL = Campeonato::find()->where(['estado' => true])->all();
$arrayCampeonato = ArrayHelper::map($modelsCampeonatoALL, 'id', 'nombre');

$pathWeb = '';
if ($model->link_logotipo) {
    $pathWeb = Yii::getAlias('@web')  . $model->link_logotipo;
}

?>

<div class="equipo-form">
    <div class="text-center">
    
    <div class=" p-1  shadow d-inline-block rounded-circle">       
        <?= Html::img($pathWeb, [
            'width' => '100px',
            'height' => '100px',
            'class' => 'rounded-circle border border-primary p-1 shadow'
        ]); ?>       
    </div>
    </div>
    <p></p>



    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <!-- <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'nombre', ['errorOptions' => ['class' => 'text-danger']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_fundacion', ['errorOptions' => ['class' => 'text-danger']])->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'link_logotipo', ['errorOptions' => ['class' => 'text-danger']])->fileInput(['maxlength' => true])->label('Escudo') ?>

    <div class="form-check form-switch">
        <?= $form->field($model, 'activo')->checkbox()->label('Activado', ['class' => '']) ?>
    </div>
    <?= $form->field($model, 'id_genero')->dropDownList($arrayCatGenero, ['prompt' => 'Seleccione...'])->label('Género') ?>

    <?= $form->field($model, 'id_categoria')->dropDownList($arrayCatCategia, ['prompt' => 'Seleccione...'])->label('Categoría') ?>

    <?= $form->field($model, 'id_campeonato')->dropDownList($arrayCampeonato, [

        'options' => [
            $modelsCampeonato->id => ['Selected' => true]
        ],
    ])->label('Campeonato') ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>