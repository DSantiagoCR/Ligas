<?php 
use yii\helpers\Html;

?>
<div class="card" style="width: 50rem; padding: 10px;" p>
    <p style="color:black"><b>Selección Directivos</b></p>
    <p style="color:red"><b>Campeonato: <?=$modelCampeonato->nombre."($modelCampeonato->anio)"?></b></p>

    <div class="row">
        <div class="col">

            <label for="ddl_categoria" class="form-label text-primary">
                Directivos
            </label>
            <select class="form-select form-select-sm" id="ddl_directivo">
                <option selected>Seleccione Opcion</option>
                <?php 
                    foreach($modelDirectivos as $item)
                    {
                ?>
                <option value="<?= $item->id?>"><?= $item->nombreApellido()?></option>
                <?php                        
                    }
                ?>
            </select>

            
            <label for="ddl_categoria" class="form-label text-primary">
                Tipo Directivo
            </label>
            <select class="form-select form-select-sm" id="ddl_tipo_directivo">
                <option selected>Seleccione Opcion</option>
                <?php 
                    foreach($modelListTipoDirectivos as $item)
                    {
                ?>
                <option value="<?= $item->id?>"><?= $item->valor?></option>
                <?php                        
                    }
                ?>
            </select>
        
            <div class="col-auto p-3">
                <!-- <button type="button" class="btn btn-primary"  onclick="addCabin()">
                    Asignar
                </button> -->
                <?= Html::button('Asignar', [
                    'class' => 'btn btn-primary',
                    'type' => 'button',
                    'onclick' => 'asignaDirectivo()'
                ]) ?>
            </div>

        </div>
        <div class="col">
            <table class="table table-bordered border-primary">
                <thead class="table-dark">
                    <tr>
                        <td> EQUIPO</td>
                        <td> DIRECTIVO</td>
                        <td> CARGO</td>
                    </tr>
                </thead>
                <tbody>
                    <?php

            foreach ($modelDirectivaEquipo as $objDE) {
            ?>
                    <tr>
                        <td> <?= $objDE->equipo->nombre ?></td>
                        <td> <?= $objDE->directivo->nombreApellido() ?></td>
                        <td> <?= $objDE->tipoDirectivo->valor ?></td>
                    </tr>
                    <?php
            } //fin for
            ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function asignaDirectivo() {
    mensajeProcesando();
    var data = {
        id_directivo: $("#ddl_directivo").val(),
        id_tipo_directivo: $("#ddl_tipo_directivo").val(),      
        id_equipo: "<?= $modelEquipo->id?>",
    }
    console.log(data);
    $.ajax({
        type: "GET",
        url: "<?= Yii::getAlias("@web") . '/equipo-config/asigna-directivo' ?>",
        data: data,
        success: function(response) {
            var data = JSON.parse(response);
            console.log(data);
            if (data.resp == 1) {
                mensajeDatoGuardados();
                setTimeout(function() {
                   // $("#mensaje").text("¡2 segundos han pasado!");
                   location.reload();
                }, 3000);
                
            } else {
                mensajeDatoNoGuardados();
            }
        },
    });
    $.unblockUI();

}
</script>