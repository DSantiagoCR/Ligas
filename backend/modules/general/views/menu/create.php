<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Menu */
$this->title = Yii::t('rbac-admin', 'Crear Menú');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">
<!--    <h1>--><?php //= Html::encode($this->title) ?><!--</h1>-->
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
