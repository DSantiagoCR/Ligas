<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Catalogos;
use common\models\Equipo;
use common\models\Jugador;
use yii\helpers\ArrayHelper;

$modelsEstadoCivil = Catalogos::find()->where(['id_catalogo'=>10])->all();
$arrayEstadoCivil = ArrayHelper::map($modelsEstadoCivil,'id','valor');
$model  = Jugador::find()->where(['id'=>10])->one();
?>

<div class="card" style="padding: 10px;" >
<h3 style="color:red">Crear Jugador </h2>
<p style="color:black"><b>Equipo: <?= $modelEquipo->nombre ?></b></p>
<p style="color:red"><b>Campeonato: <?=$modelCampeonato->nombre."($modelCampeonato->anio)"?></b></p>


<div class="jugador-form">   

    <table class="table table-bordered border-primary">
        <thead class="table-dark">
            <tr>
                <td> NOMBRE</td>               
                <td> APELLIDO</td>
                <td> CEDULA</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($modelJugadores as $objJugador) {
            ?>
                <tr>
                    <td> <?= $objJugador->nombres ?></td>
                    <td> <?= $objJugador->apellidos ?></td>
                    <td> <?= $objJugador->cedula ?></td>
                </tr>
            <?php
            } //fin for
            ?>
        </tbody>
    </table>
</div>