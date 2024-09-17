<?php

namespace common\models\Util;
use common\models\Catalogos;

class HelperGeneral
{
    public static function obtenerListaCatalogoPorIdCatalogo($id_catalogo)
    {
        return Catalogos::find()
        ->where(['id_catalogo'=>$id_catalogo])
        ->andWhere(['estado'=>true])
        ->all();
    }
    
}