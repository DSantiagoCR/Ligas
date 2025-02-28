<div id="collapse<?= $tipo ?>" class="accordion-collapse collapse show">
    <div class="accordion-body">
        <div class="row text-center">
            <div class="col-1 border bg-secondary text-dark"><b>#.</b></div>
            <div class="col-1 border bg-secondary text-dark"><b>No.</b></div>
            <div class="col-5 border bg-secondary text-dark"><b>Jugador</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b>Gol</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b>T.A</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b>T.R</b></div>
            <div class="col-1 text-center border bg-secondary text-dark"><b calss="text-center" style="font-size:10px">Carnet</b></div>

        </div>
        <?php
        $cont = 1;
        if ($modelDetVocalia) {
            foreach ($modelDetVocalia as $model) {

        ?>
                <div class="row">
                    <div class="col-1 border bg-secondary text-dark" style="font-size:10px;"><b><?= $cont ?></b></div>
                    <div class="col-1 border"><?= ($model->jugador->num_camiseta) ? $model->jugador->num_camiseta : '' ?></div>
                    <div class="col-5 border"><?= $model->jugador->nombres . ' ' . $model->jugador->apellidos ?></div>
                    <div class="col-1 text-center border">0</div>
                    <div class="col-1 text-center border">-</div>
                    <div class="col-1 text-center border">-</div>
                    <div class="col-1 text-center border">-</div>
                </div>
        <?php
                $cont = $cont + 1;
            }
        }
        ?>
    </div>
</div>