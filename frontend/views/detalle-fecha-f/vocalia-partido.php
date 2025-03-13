<?php

use common\models\Util\HelperGeneral;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->title = "Vocalia";
$cont1 = 1;
$cont2 = 1;

$modelEstadoPartido = HelperGeneral::devuelveEstadoVocalia();
$modelEstPartido = HelperGeneral::devuelveIDEstadoFinalizadoPartido();

$defaultValue =  $modelCabVocalia->id_estado_vocalia;

$classContainer = "container-ms border border-info p-3 ";
$styleC = '';
if ($defaultValue == $modelEstPartido->valor1) {
    $classContainer = "container-ms border border-info p-3 bg-ligth";
    $styleC = "pointer-events: none;";
}


?>

<!-- // cabcera -->

<div class="<?= $classContainer ?> " style="<?= $styleC ?>">

    <div class="row">
        <div class="col-1">
            <?= Html::a('MODO IMAGEN', ['vocalia-imagen', 'idDetFec' => $idDetFec], ['class' => 'btn btn-warning', 'id' => 'guardar-estado']) ?>

        </div>

        <div class="col-5">
            <div class="row  text-center p-2">
                <div class="col">
                    <h3><?= $modelLigaBarrial->nombre ?></h3>
                </div>
                <div class="row text-center">
                    <h3>HOJA DE VOCALIA CAMPEONATO " <?= $modelCampeonato->nombre . ',' . $modelCampeonato->anio ?> "<h3>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="col text-center">
                <?php
                $pathWeb = Yii::getAlias('@web');
                $pathWeb = $pathWeb . '/administrator' . $modelLigaBarrial->link_logo;
                ?>
                <?= Html::img($pathWeb, [
                    'width' => '150px',
                    'height' => '150px',
                    'class' => 'rounded-pill border border-warning shadow', // O 'rounded-circle' para hacerlo circular
                    'alt' => 'Logotipo',
                    //'onclick' => 'mostrarMensaje()'
                ]); ?>
            </div>
        </div>
        <div class="col-4">
            <div class="row border border-warning d-flex">
                <?php 
                if(!$modelCabVocalia->hora_inicia)
                {                
                ?>
                <div class="col-auto">
                    <?= Html::button('Inicia Partido', [
                        'class' => 'btn btn-warning text-bold iniciar-partido',
                        'data-id' => $modelCabVocalia->id, // ID del partido
                    ]) ?>
                </div>
                <?php 
                }else{                
                ?>
                <div class="col-auto">                    
                    <p class="text-white text-center text-bold m-0 fs-4"> Inicia Partido: <?= ($modelCabVocalia->hora_inicia) ? $modelCabVocalia->hora_inicia : '' ?></p>

                </div>
                <?php 
                }                
                ?>
            </div>
            <div class="row border border-warning ">
                <div class="col bg-info">
                    <label for="estado-partido " style="color:white">Estado del Partido</label>
                </div>
                <div class="col">
                    <select id="estado-partido" class="form-control">
                        <?php foreach ($modelEstadoPartido as $key => $value): ?>
                            <option value="<?= $key ?>" <?= ($key == $defaultValue) ? 'selected' : '' ?>>
                                <?= $value ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <?= Html::button('Guardar', ['class' => 'btn btn-success', 'id' => 'guardar-estado']) ?>
                </div>
            </div>
        </div>  
    </div>
    <br>
    <div class="row p-2 border border-success text-white">
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

    </div>

    <div class="row p-2 border border-success">
        <div class="col p-3 border border-success">
            <div class="row text-center">
                <div class="col">
                    <h3 class="bg-primary"><b><?= $modelCabVocalia->equipo1->nombre ?></b></h3>
                </div>
                <div class="col">
                    <h3 class="bg-primary"><b> Goles: <?= $goles1A ?></b></h3>
                </div>
                <div class="col d-flex"><?= Html::img($modelCabVocalia->equipo1->link_logotipo, ['width' => '40px', 'class' => 'img-fluid ms-auto']) ?></div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_1">
                        INGRESAN A CANCHA
                    </button>
                </h2>
                <?= $this->render('_jugadores_titulares', ['modelDetVocalia' => $modelDetVocalia1A, 'tipo' => '_1', 'i' => 1]) ?>

            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_2">
                        NOMINA JUGADORES
                    </button>
                </h2>
                <?= $this->render('_jugadores_suplentes', ['modelDetVocalia' => $modelDetVocalia1A, 'tipo' => '_2', 'i' => 31]) ?>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_5">
                        AMONESTADOS
                    </button>
                </h2>
                <?= $this->render('_jugadores_amonestados', ['modelDetVocalia' => $modelDetVocalia1B, 'tipo' => '_5']) ?>

            </div>
        </div>
        <div class="col p-3 border border-success">
            <div class="row text-center">
                <div class="col">
                    <h3 class="bg-primary"><b><?= $modelCabVocalia->equipo2->nombre ?></b></h3>
                </div>
                <div class="col">
                    <h3 class="bg-primary"><b> Goles: <?= $goles2A ?></b></h3>
                </div>
                <div class="col d-flex"><?= Html::img($modelCabVocalia->equipo2->link_logotipo, ['width' => '40px', 'class' => 'img-fluid ms-auto']) ?></div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_3">
                        INGRESAN A CANCHA
                    </button>
                </h2>
                <?= $this->render('_jugadores_titulares', ['modelDetVocalia' => $modelDetVocalia2A, 'tipo' => '_3', 'i' => 61]) ?>

            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_4">
                        NOMINA JUGADORES
                    </button>
                </h2>
                <?= $this->render('_jugadores_suplentes', ['modelDetVocalia' => $modelDetVocalia2A, 'tipo' => '_4', 'i' => 91]) ?>

            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_6">
                        AMONESTADOS / NO CALIFICADOS
                    </button>
                </h2>
                <?= $this->render('_jugadores_amonestados', ['modelDetVocalia' => $modelDetVocalia2B, 'tipo' => '_6']) ?>

            </div>

        </div>
    </div>
</div>

<!-- // detalle -->

<!-- // pie de pagina -->

<?php
$script = "$(document).ready(function() {";
//para los titulares 1
for ($i = 1; $i <= 30; $i++) {
    $script .= "
         $('#increment$i').click(function() {
            let input = $('#counter$i');
            let value = parseInt(input.val()) + 1;
            input.val(value).trigger('change'); // Cambia el valor y dispara el evento change
        });

        $('#decrement$i').click(function() {
            let input = $('#counter$i');
            let value = parseInt(input.val());
            if (value > 0) {
                input.val(value - 1).trigger('change'); // Cambia el valor y dispara el evento change
            }
        });
    ";
}
//para los titulares 2
for ($i = 61; $i <= 90; $i++) {
    $script .= "
         $('#increment$i').click(function() {
            let input = $('#counter$i');
            let value = parseInt(input.val()) + 1;
            input.val(value).trigger('change'); // Cambia el valor y dispara el evento change
        });

        $('#decrement$i').click(function() {
            let input = $('#counter$i');
            let value = parseInt(input.val());
            if (value > 0) {
                input.val(value - 1).trigger('change'); // Cambia el valor y dispara el evento change
            }
        });
    ";
}
//para los suplentes 1
for ($i = 31; $i <= 60; $i++) {
    $script .= "
        $('#increment$i').click(function() {
            let value = parseInt($('#counter$i').val());
            $('#counter$i').val(value + 1);
        });

        $('#decrement$i').click(function() {
            let value = parseInt($('#counter$i').val());
            if (value > 0) {
                $('#counter$i').val(value - 1);
            }
        });
    ";
}
//para los suplentes 2
for ($i = 91; $i <= 120; $i++) {
    $script .= "
        $('#increment$i').click(function() {
            let value = parseInt($('#counter$i').val());
            $('#counter$i').val(value + 1);
        });

        $('#decrement$i').click(function() {
            let value = parseInt($('#counter$i').val());
            if (value > 0) {
                $('#counter$i').val(value - 1);
            }
        });
    ";
}

$script .= "});";

$this->registerJs($script);

?>

<?php
//para guardar el estdo del partido
$this->registerJs("
$(document).on('click', '#guardar-estado', function() {
    let estado = $('#estado-partido').val(); // Obtener valor del select

    $.ajax({
        url: '" . Url::to(['detalle-fecha-f/actualiza-estado-partido']) . "',
        type: 'POST',
        data: { estado: estado,id:$modelCabVocalia->id },
        success: function(response) {
              
                    Swal.fire({
                    title: 'Elemento guardado',
                    text: 'Los cambios han sido registrados correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    timer: 3000, // Se cierra automáticamente en 3 segundos
                    showConfirmButton: false // Oculta el botón de confirmación
                    });
                    setTimeout(function() {
                            location.reload(); // Refresca la pantalla después de guardar
                        // Aquí puedes ejecutar cualquier acción después de la espera
                    }, 3000);

        
        },
        error: function() {
            alert('Error al actualizar el estado');
        }
    });
});
");

$this->registerJs(new JsExpression("
    $(document).on('click', '.iniciar-partido', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '" . Url::to(['iniciar-partido']) . "',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                if (response.success) {
                    //alert('¡El partido ha iniciado!');
                    location.reload();
                } else {
                    alert('Error al iniciar el partido.');
                }
            },
            error: function() {
                alert('Error en la petición AJAX.');
            }
        });
    });
"));

?>