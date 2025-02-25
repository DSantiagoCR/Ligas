<?php

use yii\helpers\Html;

$this->title = "Vocalia";
$cont1 = 1;
$cont2 = 1;

?>

<!-- // cabcera -->

<div class="container border border-info p-3 bg-white">
    <div class="row border border-success text-center p-2">
        <h3><?= $modelLigaBarrial->nombre ?></h3>
    </div>
    <div class="row border border-success text-center">
        <h3>HOJA DE VOCALIA CAMPEONATO " <?= $modelCampeonato->nombre . ',' . $modelCampeonato->anio ?> "<h3>
    </div>
    <br>
    <div class="row p-2 border border-success">
        <div class="col">
            <div class="col"><b>FECHA: </b><?= $modelCabFec->dia . ', ' . $modelCabFec->fecha ?></div>
            <div class="col"><b>HORA: </b><?= $modelDetFec->horaInicio->valor ?></div>
        </div>
        <div class="col">
            <div class="col"><b>ETAPA: </b><?= $modelDetFec->etapa->valor ?> </div>
            <div class="col"><b>ARBITRO: </b><?= $modelArbitros->nombre . ' ' . $modelArbitros->apellido ?></div>

        </div>
        <div class="col">
            <div class="col"><b>VOCAL: </b><?= $modelCabVocalia->id_equipo_vocal ? $modelCabVocalia->equipoVocal->nombre : '' ?></div>
            <div class="col"><b>VEEDOR: </b><?= $modelCabVocalia->id_equipo_veedor ? $modelCabVocalia->equipoVeedor->nombre : '' ?></div>
        </div>
        <div class="col">
            <img class="rounded " style="width:70px" src="<?= $modelLigaBarrial->link_logo ?>" />
        </div>
    </div>

    <div class="row p-2 border border-success">
        <div class="col p-3 border border-success">
            <div class="row">
                <div class="col">
                    <h3 class="bg-primary"><b><?= $modelCabVocalia->equipo1->nombre ?></b></h3>
                </div>
                <div class="col d-flex"><?= Html::img($modelCabVocalia->equipo1->link_logotipo, ['width' => '40px', 'class' => 'img-fluid ms-auto']) ?></div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_1">
                        TITULARES
                    </button>
                </h2>
                <?= $this->render('_jugadores_titulares',['modelDetVocalia'=>$modelDetVocalia1A,'tipo'=>'_1'])?>
               
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_2">
                        SUPLENTES
                    </button>
                </h2>
                <?= $this->render('_jugadores_suplentes',['modelDetVocalia'=>$modelDetVocalia1A,'tipo'=>'_2'])?>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_5">
                        AMONESTADOS
                    </button>
                </h2>
                <?= $this->render('_jugadores_amonestados',['modelDetVocalia'=>$modelDetVocalia1B,'tipo'=>'_5'])?>

            </div>
        </div>
        <div class="col p-3 border border-success">
            <div class="row text-center">
                <div class="col">
                    <h3 class="bg-primary"><b><?= $modelCabVocalia->equipo2->nombre ?></b></h3>
                </div>
                <div class="col d-flex"><?= Html::img($modelCabVocalia->equipo2->link_logotipo, ['width' => '40px', 'class' => 'img-fluid ms-auto']) ?></div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_3">
                        TITULARES
                    </button>
                </h2>
                <?= $this->render('_jugadores_titulares',['modelDetVocalia'=>$modelDetVocalia2A,'tipo'=>'_3'])?>
             
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_4">
                        SUPLENTEES
                    </button>
                </h2>
                <?= $this->render('_jugadores_suplentes',['modelDetVocalia'=>$modelDetVocalia2A,'tipo'=>'_4'])?>

            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_6">
                        AMONESTADOS
                    </button>
                </h2>
                <?= $this->render('_jugadores_amonestados',['modelDetVocalia'=>$modelDetVocalia2B,'tipo'=>'_6'])?>

            </div>

        </div>
    </div>
</div>

<div class="container mt-5 text-center">
    <h3>Contador</h3>
    
    <div class="d-flex justify-content-center align-items-center">
        <button id="decrement" class="btn btn-danger">➖</button>
        <input type="text" id="counter" class="form-control text-center mx-2" value="0" readonly style="width: 80px;">
        <button id="increment" class="btn btn-success">➕</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#increment").click(function() {
            let value = parseInt($("#counter").val());
            $("#counter").val(value + 1);
        });

        $("#decrement").click(function() {
            let value = parseInt($("#counter").val());
            if (value > 0) {
                $("#counter").val(value - 1);
            }
        });
    });
</script>

<!-- // detalle -->

<!-- // pie de pagina -->