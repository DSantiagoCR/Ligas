<?php

namespace frontend\controllers;

use common\models\Arbitros;
use common\models\CabeceraFechas;
use common\models\CabeceraVocalia;
use Yii;
use common\models\DetalleFecha;
use common\models\DetalleVocalia;
use common\models\Equipo;
use common\models\Jugador;
use common\models\LigaBarrial;
use common\models\search\DetalleFechaSearch;
use common\models\Util\HelperGeneral;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * DetalleFechaFController implements the CRUD actions for DetalleFecha model.
 */
class DetalleFechaFController extends Controller
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
     * Lists all DetalleFecha models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetalleFechaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndex1()
    {
        $modelCabFechas = CabeceraFechas::find()
            ->where(['estado' => true])
            ->andWhere(['in', 'id_estado_fecha', [45, 49]])
            ->orderBy(['fecha' => SORT_ASC])
            ->all();

        $modelDetFechas = DetalleFecha::find()
            ->where(['in', 'id_cabecera_fecha', ArrayHelper::map($modelCabFechas, 'id', 'id')])
            ->orderBy(['hora_inicio' => SORT_ASC])
            ->all();

        return $this->render('index1', [
            'modelCabFechas' => $modelCabFechas,
            'modelDetFechas' => $modelDetFechas,
        ]);
    }


    /**
     * Displays a single DetalleFecha model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "DetalleFecha #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new DetalleFecha model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new DetalleFecha();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new DetalleFecha",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new DetalleFecha",
                    'content' => '<span class="text-success">Create DetalleFecha success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Create new DetalleFecha",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing DetalleFecha model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update DetalleFecha #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "DetalleFecha #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update DetalleFecha #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing DetalleFecha model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing DetalleFecha model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    public function actionFechas($dia = null)
    {

        $modelCabFechas = CabeceraFechas::find()
            ->where(['estado' => true])
            ->andWhere(['in', 'id_estado_fecha', [45, 49]])
            ->orderBy(['fecha' => SORT_ASC])
            ->all();

        if ($dia) {
            $modelCabFechas = CabeceraFechas::find()
                ->where(['estado' => true])
                ->andWhere(['in', 'id_estado_fecha', [45, 49]])
                ->andWhere(['dia' => $dia])
                ->orderBy(['fecha' => SORT_ASC])
                ->all();
        }
        $modelCabFechas = CabeceraFechas::find()
            ->where(['estado' => true])
            ->andWhere(['in', 'id_estado_fecha', [45, 49]])
            ->andWhere(['dia' => $dia])
            ->orderBy(['fecha' => SORT_ASC])
            ->all();

        $modelDetFechas = DetalleFecha::find()
            ->where(['in', 'id_cabecera_fecha', ArrayHelper::map($modelCabFechas, 'id', 'id')])
            ->orderBy(['hora_inicio' => SORT_ASC])
            ->all();

        return $this->render('vocalias', [
            'modelCabFechas' => $modelCabFechas,
            'modelDetFechas' => $modelDetFechas,
        ]);
    }

    public function actionVocalia($idDetFec)
    {
        $modelDetFec = DetalleFecha::findOne($idDetFec);
        $modelCabFec = CabeceraFechas::findOne($modelDetFec->id_cabecera_fecha);

        $modelLigaBarrial = LigaBarrial::find()->one();

        $modelCampeonato = HelperGeneral::devuelveCampeonatoActual();

        $modelArbitros = Arbitros::find()
            ->alias('a')
            ->innerJoin(['n' => 'nucle_arbitros'], 'n.id = a.id_nucleo_arbitro')
            ->where([
                'a.estado' => true,
                'n.estado' => true,
            ])
            ->one();


        $modelEstadoVocalia = HelperGeneral::devuelveEstadoVocaliaObj();
        $modelEquipos1 = Equipo::find()
            ->where(['id' => $modelDetFec->grupoEquipo1->id_equipo])
            ->one();
        $modelEquipos2 = Equipo::find()
            ->where(['id' => $modelDetFec->grupoEquipo2->id_equipo])
            ->one();

        $modelJugadores1 = Jugador::find()
            ->where(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
            ->andWhere(['puede_jugar' => true])
            ->andWhere(['estado' => true])
            ->all();

        $modelJugadores2 = Jugador::find()
            ->where(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
            ->andWhere(['puede_jugar' => true])
            ->andWhere(['estado' => true])
            ->all();


        $modelCabVocalia = CabeceraVocalia::find()->where(['id_det_fecha' => $modelDetFec->id])->one();

        $modelDetVocalia = DetalleVocalia::find()->where(['id_cabecera_vocalia' => $modelCabVocalia->id])->one();

        $modelDetVocalia1 = new DetalleVocalia();
        $modelDetVocalia2 = new DetalleVocalia();

        if (!$modelDetVocalia) {

            foreach ($modelJugadores1 as $jugador) {
                $modelDetVocalia1->id_cabecera_vocalia = $modelCabVocalia->id;
                $modelDetVocalia1->ta = 0;
                $modelDetVocalia1->tr = 0;
                $modelDetVocalia1->goles = 0;
                $modelDetVocalia1->entrega_carnet = 0;
                $modelDetVocalia1->id_jugador = $jugador->id;
                $modelDetVocalia1->id_equipo = $jugador->id_equipo;
                $modelDetVocalia1->puede_jugar = $jugador->puede_jugar;
                $modelDetVocalia1->estado = $jugador->estado;
                $modelDetVocalia1->save();
            }


            foreach ($modelJugadores2 as $jugador) {
                $modelDetVocalia2->id_cabecera_vocalia = $modelCabVocalia->id;
                $modelDetVocalia2->ta = 0;
                $modelDetVocalia2->tr = 0;
                $modelDetVocalia2->goles = 0;
                $modelDetVocalia2->entrega_carnet = 0;
                $modelDetVocalia2->id_jugador = $jugador->id;
                $modelDetVocalia2->id_equipo = $jugador->id_equipo;
                $modelDetVocalia2->puede_jugar = $jugador->puede_jugar;
                $modelDetVocalia2->estado = $jugador->estado;
                $modelDetVocalia2->save();
            }
        }
        $modelDetVocalia1 = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelCabVocalia->id_equipo_1])
            ->one();

        $modelDetVocalia2 = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelCabVocalia->id_equipo_2])
            ->one();

        return $this->render('vocalia-partido', [
            'modelLigaBarrial' => $modelLigaBarrial,
            'modelCabFec' => $modelCabFec,
            'modelDetFec' => $modelDetFec,
            'modelCampeonato' => $modelCampeonato,
            'modelArbitros' => $modelArbitros,
            'modelEstadoVocalia' => $modelEstadoVocalia,
            'modelEquipos1' => $modelEquipos1,
            'modelEquipos2' => $modelEquipos2,
            'modelDetVocalia1' => $modelDetVocalia1,
            'modelDetVocalia2' => $modelDetVocalia2,
            'modelCabVocalia' => $modelCabVocalia,
        ]);
    }

    /**
     * Finds the DetalleFecha model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DetalleFecha the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DetalleFecha::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
