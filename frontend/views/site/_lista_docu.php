<?php

use common\models\Campeonato;
use common\models\Documentos;
use common\models\LigaBarrial;
use yii\helpers\Html;

$modelCampeonato = Campeonato::find()->where(['estado'=>true])->one();
$modelDocumetos = Documentos::find()->where(['estado'=>1,'id_campeonato'=>$modelCampeonato->id])->all();

?>



<h2>Documentos</h2>
    <ul>
        <?php
        foreach($modelDocumetos as $docu )
        { 
        ?>
            <li><?= Html::a($docu->nombre,$docu->link,[
                'target'=>'_blank',
                //'style' => 'color: inherit; text-decoration: none;'
                ])?></li>
        <?php
         }
        ?>
    </ul>
