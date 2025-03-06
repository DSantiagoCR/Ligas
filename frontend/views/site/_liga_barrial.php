<?php

use common\models\LigaBarrial;
use common\models\Util\HelperGeneral;

$modelLigaBarrial = LigaBarrial::find()->where(['estado' => 1])->one();
$modelCampeonato = HelperGeneral::devuelveCampeonatoActual();
?>
<div class="text-white fs-2">
    <?= $modelLigaBarrial->nombre ?>
    <br>
    Fundación: <?= $modelLigaBarrial->fecha_fundacion ?>
</div>
</br>
<div class="text-white fs-5">

    <b>
        <scan style="font-size: 20px;">Campeonato:</scan>
    </b>
    <?= $modelCampeonato->nombre ?>
    </br>
    <b>
        <scan style="font-size: 20px;">Periodo:</scan>
    </b>
    <?= $modelCampeonato->anio ?>
</div>