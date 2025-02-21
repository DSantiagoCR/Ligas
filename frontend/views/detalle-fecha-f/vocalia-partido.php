<?php


$this->title = "Vocalia";

// print_r($modelDetVocalia1);
// die();
?>

<!-- // cabcera -->

<div class="container border border-info p-3 bg-white">
    <div class="row border border-success text-center p-2">
        <h2><?= $modelLigaBarrial->nombre ?></h1>
    </div>
    <div class="row border border-success text-center">
        <h2>HOJA DE VOCALIA CAMPEONATO " <?= $modelCampeonato->nombre . ',' . $modelCampeonato->anio ?> "<h2>
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
            <img class="w-25 rounded " src="<?= $modelLigaBarrial->link_logo ?>" />
        </div>
    </div>

    <div class="row p-2 border border-success">
        <div class="col border border-success">
            <b>EQUIPO 1</b>
            <div class="row">
                <div class="col-1"><b>No.</b></div>
                <div class="col-6"><b>Jugador</b></div>
                <div class="col-1"><b>Goles</b></div>
                <div class="col-1"><b>T.A</b></div>
                <div class="col-1"><b>T.R</b></div>
            </div>
            <?php foreach ($modelDetVocalia1 as $model) { ?>
                <div class="row">
                    <div class="col-1 border"><?=($model->jugador->num_camiseta)?$model->jugador->num_camiseta:''?></div>
                    <div class="col-6 border"><?=$model->jugador->nombres.' '.$model->jugador->apellidos?></div>
                    <div class="col-1 border">0</div>
                    <div class="col-1 border">-</div>
                    <div class="col-1 border">-</div>
                </div>
            <?php } ?>
        </div>
        <div class="col border border-success">
            <b>EQUIPO 2</b>
            <div class="row">
            <div class="col-1"><b>No.</b></div>
                <div class="col-6"><b>Jugador</b></div>
                <div class="col-1"><b>Goles</b></div>
                <div class="col-1"><b>T.A</b></div>
                <div class="col-1"><b>T.R</b></div>
            </div>
            <?php foreach ($modelJugadores2 as $model1) { ?>
                <div class="row">
                    <div class="col-1 border"><?=($model->jugador->num_camiseta)?$model->jugador->num_camiseta:''?></div>
                    <div class="col-6 border"><?=$model1->jugador->nombres.' '.$model1->jugador->apellidos?></div>
                    <div class="col-1 border">0</div>
                    <div class="col-1 border">-</div>
                    <div class="col-1 border">-</div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



<!-- // detalle -->

<!-- // pie de pagina -->