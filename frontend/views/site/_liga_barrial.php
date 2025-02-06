<?php

use common\models\LigaBarrial;

$modelLigaBarrial = LigaBarrial::find()->where(['estado'=>1])->one();

?>

<?= $modelLigaBarrial->nombre ?>
<br>
Fundación: <?= $modelLigaBarrial->fecha_fundacion ?>
