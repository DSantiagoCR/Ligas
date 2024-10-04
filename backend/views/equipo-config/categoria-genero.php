<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Equipo;
use common\models\search\EquipoSearch;
use yii\bootstrap4\Modal;

?>
<div class="card" style="padding: 10px;" >
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
            <div class="col-auto p-3">
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
                        <td> Equipo</td>
                        <td> Categoría</td>
                        <td> Género</td>
                        <td> Estado</td>
                        <td> Accion</td>
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
                        <td>
                            <?php
                            if ($objEC->estado )
                            { 
                            ?>
                            <i class="fas fa-check-circle" style="color:green"></i>
                            <?php
                            }
                            else
                            { 
                            ?>
                            <i class="fas fa-exclamation-circle" style="color:red"></i>
                            <?php
                            }                         
                            ?>
                        </td>
                        <td>
                            <?= Html::button('<i class="fas fa-trash-alt fa-xs"></i>', [
                                'value' => Url::to(['equipo/index']),
                                'class' => 'btn btn-outline-primary btn-sm',
                                'id' => 'modalButton1',
                                'title' => 'Eliminar',
                            ]) ?>
                            <?= Html::button('<i class="fas fa-trash-alt"></i>', [
                                'class' => 'btn btn-danger btn-sm', // Estilos del botón
                                'id' => 'deleteButton', // ID para capturar el evento
                                'data-url' => Url::to(['equipo/delete', 'id' => 200]), // URL del controlador de eliminación
                                'data-toggle' => 'tooltip',
                                'role'=>'modal-remote',
                                'title' => 'Eliminar',
                                'data-confirm-title' => '¿Estás seguro?',
                                'data-confirm-message' => '¿Estás seguro de que deseas eliminar este elemento?',
                                'data-method' => 'post' // Método POST para la solicitud
                            ]) ?>
                        </td>
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

<!-- Modal de confirmación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmación de eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="deleteModalMessage">¿Estás seguro de que deseas eliminar este elemento?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<script>
    
$(document).ready(function() {
    var urlToDelete; // Variable global para almacenar la URL del registro a eliminar

    // Capturar el clic del botón de eliminación
    $('#deleteButton').click(function() {
        urlToDelete = $(this).data('url'); // Guardar la URL en una variable
        var confirmTitle = $(this).data('confirm-title'); // Título del modal
        var confirmMessage = $(this).data('confirm-message'); // Mensaje de confirmación

        // Actualizar el título y mensaje del modal
        $('#deleteModalLabel').text(confirmTitle);
        $('#deleteModalMessage').text(confirmMessage);

        // Mostrar el modal
        $('#deleteModal').modal('show');
    });

    // Asignar el evento click al botón de confirmación (solo una vez)
    $('#confirmDeleteButton').click(function() {
        // Hacer la solicitud AJAX para eliminar el registro
        $.ajax({
            url: urlToDelete, // Usar la URL almacenada
            type: 'POST',
            success: function(response) {
                // Procesar la respuesta del servidor
                if (response.success) {
                    // Cerrar el modal
                    $('#deleteModal').modal('hide');
                    // Actualizar la página o la tabla
                    location.reload();
                } else {
                    alert('Error al eliminar el registro.');
                }
            },
            error: function() {
                alert('Ocurrió un error al intentar eliminar el registro.');
            }
        });
    });
});

</script>