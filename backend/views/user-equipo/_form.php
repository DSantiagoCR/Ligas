<?php

use common\models\Campeonato;
use common\models\Equipo;
use common\models\GrupoEquipo;
use common\models\Grupos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\UserEquipo;

/* @var $this yii\web\View */
/* @var $model common\models\UserEquipo */
/* @var $form yii\widgets\ActiveForm */

$modelCampeonato2 = Campeonato::find()->where(['estado'=>true])->one();
$modelCampeonato = Campeonato::find()->where(['estado'=>true])->all();
$arrayCampeonato = ArrayHelper::map($modelCampeonato,'id','nombre');

$modelUserEquipos = UserEquipo::find()
->select('id_equipo')
->where(['id_campeonato'=>$modelCampeonato2->id])
->all();

$arrayUserEquipos = ArrayHelper::map($modelUserEquipos,'id_equipo','id_equipo');

$modelEquipos = Equipo::find()
->where(['activo'=>true])
->andWhere(['id_campeonato' => $modelCampeonato2->id])
->andWhere(['not in','id',$arrayUserEquipos])
->all();

$arrayEquipos = ArrayHelper::map($modelEquipos, 'id', function($model) {  
    return $model->nombre . ' - ' . $model->categoria->valor . ' - '. $model->genero->valor;
});


$modelUsuario = User::find()->where(['status'=>10])->all();
$arrayUser = ArrayHelper::map($modelUsuario,'id','username');

?>

<div class="user-equipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_equipo')->dropDownList($arrayEquipos,['prompt'=>'Seleccione...'])->label('Equipo') ?>

    <?= $form->field($model, 'id_user')->dropDownList($arrayUser,['prompt'=>'Seleccione...'])->label('Usuario') ?>
    
    <?= $form->field($model, 'id_campeonato')->dropDownList($arrayCampeonato,['prompt'=>'Seleccione..'])->label('Campeonato') ?>



    <?= $form->field($model, 'estado')->dropDownList(
    [1 => 'Activo', 0 => 'Inactivo'], 
    [
        'class' => 'form-control', 
        'options' => [
            1 => ['class' => 'bg-success text-white'], 
            0 => ['class' => 'bg-danger text-white']
        ]
    ]
) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
