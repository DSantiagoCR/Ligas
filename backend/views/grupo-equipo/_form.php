<?php

use common\models\Campeonato;
use common\models\Equipo;
use common\models\GrupoEquipo;
use common\models\Grupos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GrupoEquipo */
/* @var $form yii\widgets\ActiveForm */

$modelCampeonato2 = Campeonato::find()->where(['estado'=>true])->one();
$modelCampeonato = Campeonato::find()->where(['estado'=>true])->all();
$arrayCampeonato = ArrayHelper::map($modelCampeonato,'id','nombre');

$modelGrupo = Grupos::find()->where(['id'=>$model->id_grupo])->all();
$modelGrupo2 = Grupos::find()->where(['id'=>$model->id_grupo])->one();
$arrayGrupo = ArrayHelper::map($modelGrupo,'id','nombre');

/* traemos todos los grupos que le pertenecen a una categoria/genero/etapa */ 
$modelGrupos = Grupos::find()
->where(['estado'=>true])
->andWhere(['id_catalogo' => $modelGrupo2->id_catalogo])
->andWhere(['id_categoria'=>$modelGrupo2->id_categoria])
->andWhere(['id_genero'=>$modelGrupo2->id_genero])
->all();

$arrayGrupos=[];
foreach($modelGrupos as $model0)
{
    $arrayGrupos[] = $model0->id;
}

/* traemos todos los grupos que le pertenecen a una categoria/genero/etapa */ 
$modelGrupoEquipos = GrupoEquipo::find()->where(['in','id_grupo', $arrayGrupos])->all();
$arrayGruposEquipo=[];
foreach($modelGrupoEquipos as $model1)
{
    $arrayGruposEquipo[] = $model1->id_equipo;
}

$modelEquipos = Equipo::find()
->where(['activo'=>true])
->andWhere(['id_campeonato' => $modelCampeonato2->id])
->andWhere(['id_categoria'=>$modelGrupo2->id_categoria])
->andWhere(['id_genero'=>$modelGrupo2->id_genero])
->andWhere(['not in','id',$arrayGruposEquipo])
->all();

// echo '<pre>';
// // print_r($modelEquipos);
// foreach($modelEquipos as $model2)
// {
//     print_r($model2->nombre);
//     echo'<br>';
// }
// die();

$arrayEquipos = ArrayHelper::map($modelEquipos, 'id', function($model) {  
    return $model->nombre . ' - ' . $model->categoria->valor . ' - '. $model->genero->valor;
});

?>



<div class="grupo-equipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_campeonato')->dropDownList($arrayCampeonato,[
        'options' => [
            $modelCampeonato2->id => ['Selected' => true]
        ],
    ])->label('Campeonato') ?>

    <?= $form->field($model, 'id_grupo')->dropDownList($arrayGrupo,['prompt'=>'Seleccione...','disabled'=>true])->label('Grupo') ?>

    <?= $form->field($model, 'id_equipo')->dropDownList($arrayEquipos,['prompt'=>'Seleccione...'])->label('Equipo') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
