<?php

namespace common\models\Util;

use common\models\Campeonato;
use Yii;
use common\models\Catalogos;
use common\models\UserEquipo;
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
    public static function devuelveEquipoUsuario()
    {       
        $id_user = Yii::$app->user->identity ? Yii::$app->user->identity->id : null;

        if ($id_user)
        {
            $modelUserEquipo = UserEquipo::find()
            ->where(['id_user'=>$id_user,'estado'=>1])->all();
            return $modelUserEquipo;
        }
        return null; 
    }
    public static function devuelveCampeonatoActual()
    {       
        $modelCampeonato = Campeonato::find()->where(['estado'=>1])->one();
        return $modelCampeonato;
    }
}
