<?php

namespace common\models\Util;

use common\models\Catalogos;
use common\models\Grupos;
use yii\helpers\ArrayHelper;

class HelperGeneral
{
    public static function obtenerListaCatalogoPorIdCatalogo($id_catalogo)
    {
        return Catalogos::find()
            ->where(['id_catalogo' => $id_catalogo])
            ->andWhere(['estado' => true])
            ->all();
    }

    public static  function helperArrayEtapas()
    {
        $modelEtapas = self::obtenerListaCatalogoPorIdCatalogo(27);
        $arrayEtapas = ArrayHelper::map($modelEtapas, 'id', 'valor');
        return $arrayEtapas;
    }
    public static  function helperArrayEstadoPartido()
    {
        $modelEstadoPardito = Catalogos::find()->where(['id_catalogo' => 50, 'estado' => true])->all();
        $arrayEstadoPartido = ArrayHelper::map($modelEstadoPardito, 'id', 'valor');
        return $arrayEstadoPartido;
    }
    public static  function helperArrayHoraPartido()
    {
        $modelhorasPartido = Catalogos::find()->where(['id_catalogo' => 56, 'estado' => true])->all();
        $arrayHorasPartido = ArrayHelper::map($modelhorasPartido, 'id', 'valor');
        return $arrayHorasPartido;
    }
}
