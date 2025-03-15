<?php

namespace common\models\Util;

use common\models\Campeonato;
use Yii;
use common\models\Catalogos;
use common\models\Equipo;
use common\models\Parametros;
use common\models\UserEquipo;
use DateTime;
use yii\helpers\ArrayHelper;

class HelperGeneral
{
    public static function obtenerListaCatalogoPorIdCatalogo($id_catalogo)
    {
        return Catalogos::find()
            ->where(['id_catalogo' => $id_catalogo])
            ->andWhere(['estado' => true])
            ->orderBy(['code'=>SORT_ASC])
            ->all();

       
    }
    public static function obtenerArrayCatalogoPorIdCatalogo($id_catalogo)
    {
        $models= Catalogos::find()
            ->where(['id_catalogo' => $id_catalogo])
            ->andWhere(['estado' => true])
            ->orderBy(['code'=>SORT_ASC])
            ->all();

            $array = ArrayHelper::map($models, 'id', 'valor');
            return $array;
    }

    public static  function helperArrayEtapas()
    {
       return self::obtenerArrayCatalogoPorIdCatalogo(27);
    }
    public static  function devuelveEtapasCampeonatoObj()
    {
        return self::obtenerListaCatalogoPorIdCatalogo(27);
    }
    public static  function helperArrayEstadoPartido()
    {
        return self::obtenerArrayCatalogoPorIdCatalogo(50);
    }
    public static  function helperArrayHoraPartido()
    {
         return self::obtenerArrayCatalogoPorIdCatalogo(56);
    }
    public static function devuelveEquipoUsuario()
    {
        $id_user = Yii::$app->user->identity ? Yii::$app->user->identity->id : null;

        if ($id_user) {
            $modelUserEquipo = UserEquipo::find()
                ->where(['id_user' => $id_user, 'estado' => 1])->all();
            return $modelUserEquipo;
        }
        return null;
    }
    public static function devuelveCampeonatoActual()
    {
        $modelCampeonato = Campeonato::find()->where(['estado' => 1])->one();
        return $modelCampeonato;
    }
    public static function devuelveArrayEstadoCivil()
    {
        return self::obtenerArrayCatalogoPorIdCatalogo(10);
    }
    public static function devuelveTipoDirectivo()
    {
        return self::obtenerArrayCatalogoPorIdCatalogo(1);
    }
    public static function devuelveCategoriasEquipos()
    {
        return self::obtenerArrayCatalogoPorIdCatalogo(21);
    }
    public static function devuelveCategoriasEquiposObj()
    {        
        return self::obtenerListaCatalogoPorIdCatalogo(21);
    }
    public static function devuelveGenerosEquipos()
    {
        return self::obtenerArrayCatalogoPorIdCatalogo(17);
    }
    public static function devuelveGenerosEquiposObj()
    {
        return self::obtenerListaCatalogoPorIdCatalogo(17);
    }
    public static function devuelveDiasHabilesObj()
    {
        return self::obtenerListaCatalogoPorIdCatalogo(31);
    }
    public static function devuelveDiasHabiles()
    {
        return self::obtenerArrayCatalogoPorIdCatalogo(31);
    }
    public static function devuelveEstadoVocalia()
    {
        return self::obtenerArrayCatalogoPorIdCatalogo(50);
    }
    public static function devuelveEstadoVocaliaObj()
    {    
        return self::obtenerListaCatalogoPorIdCatalogo(50); 
    }
    public static function devuelveEquiposCampeonatoActual()
    {
        $modelCampeonato = self::devuelveCampeonatoActual();
        $modelEquipos = Equipo::find()->where(['activo' => 1, 'id_campeonato' => $modelCampeonato->id])->all();
        $arrayEquipo = ArrayHelper::map($modelEquipos, 'id', function ($model) {
            return $model->nombre . ' - ' . $model->categoria->valor . ' - ' . $model->genero->valor;
        });

        return $arrayEquipo;
    }
    public static function calcularEdadCompleta($fechaNacimiento)
    {

        if ($fechaNacimiento) {
            $fechaNac = new DateTime($fechaNacimiento);
            $hoy = new DateTime();
            $diferencia = $hoy->diff($fechaNac);

            return "{$diferencia->y} años, {$diferencia->m} meses y {$diferencia->d} días";
        }
        return '';
    }
    public static function devuelveIDEstadoFinalizadoPartido()
    {
        $model = Parametros::find()->where(['code'=>'id_finaliza_partido'])->one();
        return $model;
    }
}