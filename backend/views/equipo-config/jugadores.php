
<div class="card" style="width: 50rem; padding: 10px;" p>
    <p style="color:black"><b>Selección de Juagadores</b></p>
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