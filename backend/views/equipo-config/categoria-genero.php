<?php 
use yii\helpers\Html;

?>
<div class="card" style="width: 50rem; padding: 10px;" p>
    <p style="color:black"><b>Selección de Categoria y Género</b></p>
    <div class="row">
        <div class="col">

            <label for="ddl_categoria" class="form-label text-primary">
                Categoria
            </label>
            <select class="form-select form-select-sm" id="ddl_categoria">
                <option selected>Seleccione Opcion</option>
                <?php 
                    foreach($modelListCategoria as $item)
                    {
                ?>
                <option value="<?= $item->id?>"><?= $item->valor?></option>
                <?php                        
                    }
                ?>
            </select>

            <label for="ddl_genero" class="form-label text-primary">
                Género
            </label>
            <select class="form-select form-select-sm" id="ddl_genero">
                <option selected>Seleccione Opcion</option>
                <?php 
                    foreach($modelListGenero as $item)
                    {
                ?>
                <option value="<?= $item->id?>"><?= $item->valor?></option>
                <?php                        
                    }
                ?>
            </select>
            <div class="col-auto p-3" >
                <!-- <button type="button" class="btn btn-primary"  onclick="addCabin()">
                    Asignar
                </button> -->
                <?= Html::button('Asignar', [
                    'class' => 'btn btn-primary',
                    'type' => 'button',
                    'onclick' => 'asignaCatalogoGenero()'
                ]) ?>
            </div>

        </div>
        <div class="col">
            <table class="table table-bordered border-primary">
                <thead class="table-dark">
                    <tr>
                        <td> EQUIPO</td>
                        <td> CATEGORIA</td>
                        <td> GENERO</td>
                    </tr>
                </thead>
                <tbody>
                    <?php

            foreach ($modelEquipoCategoria as $objEC) {
            ?>
                    <tr>
                        <td> <?= $objEC->equipo->nombre ?></td>
                        <td> <?= $objEC->categoria->valor ?></td>
                        <td> <?= $objEC->genero->valor ?></td>
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
function asignaCatalogoGenero() {
    mensajeProcesando();
    var data = {
        id_categoria: $("#ddl_categoria").val(),
        id_genero: $("#ddl_genero").val(),
        id_equipo: "<?= $modelEquipo->id?>",

    }
    $.ajax({
        type: "GET",
        url: "<?= Yii::getAlias("@web") . '/equipo-config/asigna-categoria-genero' ?>",
        data: data,
        success: function(response) {
            var data = JSON.parse(response);
            console.log(data);
            if (data.resp == 1) {
                Swal.fire(
                    'Genial !!',
                    'Datos Guardados de Forma Correcta',
                    'success'
                   );
                setTimeout(function() {
                   // $("#mensaje").text("¡2 segundos han pasado!");
                   location.reload();
                }, 3000);

                
            } else {
                Swal.fire(
                    'Opss!!',
                    'Datos no Guardados',
                    'error'
                )
            }
        },
    });
    $.unblockUI();

}
</script>