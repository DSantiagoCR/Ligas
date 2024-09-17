
<div class="card" style="width: 50rem; padding: 10px;" p>
    <p style="color:black"><b>Selección de Juagadores</b></p>
    <table class="table table-bordered border-primary">
        <thead class="table-dark">
            <tr>
                <td> NOMBRE</td>
                <td> </td>
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