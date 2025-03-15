<?php

namespace frontend\controllers;

use yii\web\UploadedFile;
use Yii;
use common\models\Jugador;
use common\models\search\JugadorSearch;
use common\models\UserEquipo;
use common\models\Util\HelperGeneral;
use common\models\Util\ImageCrud;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * JugadorFController implements the CRUD actions for Jugador model.
 */
class ReportesFController extends Controller
{
    /**
     * @inheritdoc
     */



    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Jugador models.
     * @return mixed
     */
    public function actionIndex()
    {       
        $modelGeneros = HelperGeneral::devuelveGenerosEquiposObj();
        $modelCategoria = HelperGeneral::devuelveCategoriasEquiposObj();
        $modelEtapa = HelperGeneral::devuelveCategoriasEquiposObj();

        return $this->render('index', [
            'modelGeneros' => $modelGeneros,
            'modelCategoria' => $modelCategoria,
            'modelEtapa' => $modelEtapa
        ]);
    }


}
