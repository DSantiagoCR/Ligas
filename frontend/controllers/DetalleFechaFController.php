<?php

namespace frontend\controllers;

use common\models\Arbitros;
use common\models\CabeceraFechas;
use common\models\CabeceraVocalia;
use Yii;
use common\models\DetalleFecha;
use common\models\DetalleVocalia;
use common\models\Equipo;
use common\models\GrupoEquipo;
use common\models\Jugador;
use common\models\LigaBarrial;
use common\models\search\DetalleFechaSearch;
use common\models\UserEquipo;
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

    public function actionFechas($dia = null, $soloMiEquipo = false)
    {
        $modelCabFechas = CabeceraFechas::find()
            ->where(['estado' => true])
            ->andWhere(['in', 'id_estado_fecha', [45, 49]]) //45=pendiente, 49=Suspendido
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

        $modelDetFechas = DetalleFecha::find()
            ->where(['in', 'id_cabecera_fecha', ArrayHelper::map($modelCabFechas, 'id', 'id')])
            ->orderBy(['hora_inicio' => SORT_ASC])
            ->all();

        if ($soloMiEquipo) {

            $modelCampeonato = HelperGeneral::devuelveCampeonatoActual();
            $id_user = Yii::$app->user->identity->getId();

            $userEquipo = UserEquipo::find()
                ->where(['id_user' => $id_user])
                ->one();

            $modelCabVocalia = CabeceraVocalia::find()
                ->where(['in', 'id_cab_fecha', ArrayHelper::map($modelCabFechas, 'id', 'id')])
                ->andWhere([
                    'or',
                    ['id_equipo_vocal' => $userEquipo->id_equipo],
                    ['id_equipo_veedor' => $userEquipo->id_equipo],
                    ['id_equipo_1' => $userEquipo->id_equipo],
                    ['id_equipo_2' => $userEquipo->id_equipo],

                ])
                ->all();

            $arrayCabVocaliaIdDetFecha = ArrayHelper::map($modelCabVocalia, 'id_det_fecha', 'id_det_fecha');

            $modelDetFechas = DetalleFecha::find()
                ->where(['in', 'id_cabecera_fecha', ArrayHelper::map($modelCabFechas, 'id', 'id')])
                ->where(['in', 'id', $arrayCabVocaliaIdDetFecha])
                ->orderBy(['hora_inicio' => SORT_ASC])
                ->all();
        }


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
            ->all();

        $modelJugadores2 = Jugador::find()
            ->where(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
            ->all();

        $modelCabVocalia = CabeceraVocalia::find()->where(['id_det_fecha' => $modelDetFec->id])->one();


        // 1A Y 2A = HABILITADOS PARA JUGAR
        $modelDetVocalia1A = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
            ->andWhere(['puede_jugar' => true])
            ->orderBy(['id_jugador' => SORT_ASC])
            ->all();

        $modelDetVocalia2A = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
            ->andWhere(['puede_jugar' => true])
            ->orderBy(['id_jugador' => SORT_ASC])
            ->all();

        //1B Y 2B  AMONESTADOS=SUSPENDIDOS
        $modelDetVocalia1B = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
            ->andWhere(['puede_jugar' => false])
            ->orderBy(['id_jugador' => SORT_ASC])
            ->all();


        $modelDetVocalia2B = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
            ->andWhere(['puede_jugar' => false])
            ->orderBy(['id_jugador' => SORT_ASC])
            ->all();

        $goles1A = 0;
        foreach ($modelDetVocalia1A as $model) {
            $goles1A = $goles1A + ($model->goles ? $model->goles : 0);
        }
        $goles2A = 0;
        foreach ($modelDetVocalia2A as $model) {
            $goles2A = $goles2A + ($model->goles ? $model->goles : 0);
        }


        if (!$modelDetVocalia1A) {

            foreach ($modelJugadores1 as $jugador) {
                $modelDetVocalia1 = new DetalleVocalia();
                $modelDetVocalia1->id_cabecera_vocalia = $modelCabVocalia->id;
                $modelDetVocalia1->ta = 0;
                $modelDetVocalia1->tr = 0;
                $modelDetVocalia1->goles = 0;
                $modelDetVocalia1->entrega_carnet = 0;
                $modelDetVocalia1->id_jugador = $jugador->id;
                $modelDetVocalia1->id_equipo = $jugador->id_equipo;
                $modelDetVocalia1->puede_jugar = $jugador->puede_jugar;
                $modelDetVocalia1->estado = $jugador->estado;
                $modelDetVocalia1->num_jugador = $jugador->num_camiseta . '';
                $modelDetVocalia1->nom_jugador = $jugador->nombres . ' ' . $jugador->apellidos;

                $modelDetVocalia1->save();
                // if(!$modelDetVocalia1->save())
                // {
                //     print_r($modelDetVocalia1->errors);
                //     die();
                // }

            }

            $modelDetVocalia1A = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
                ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
                ->andWhere(['puede_jugar' => true])
                ->orderBy(['id_jugador' => SORT_ASC])
                ->all();



            $modelDetVocalia1B = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
                ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
                ->andWhere(['puede_jugar' => false])
                ->orderBy(['id_jugador' => SORT_ASC])
                ->all();



            foreach ($modelDetVocalia1A as $model) {
                $goles1A = $goles1A + ($model->goles ? $model->goles : 0);
            }
        }

        if (!$modelDetVocalia2A) {

            foreach ($modelJugadores2 as $jugador) {



                $modelDetVocalia2 = new DetalleVocalia();
                $modelDetVocalia2->id_cabecera_vocalia = $modelCabVocalia->id;
                $modelDetVocalia2->ta = 0;
                $modelDetVocalia2->tr = 0;
                $modelDetVocalia2->goles = 0;
                $modelDetVocalia2->entrega_carnet = 0;
                $modelDetVocalia2->id_jugador = $jugador->id;
                $modelDetVocalia2->id_equipo = $jugador->id_equipo;
                $modelDetVocalia2->puede_jugar = $jugador->puede_jugar;
                $modelDetVocalia2->estado = $jugador->estado;
                $modelDetVocalia2->num_jugador = $jugador->num_camiseta;
                $modelDetVocalia2->nom_jugador = $jugador->nombres . ' ' . $jugador->apellidos;
                $modelDetVocalia2->save();
            }
            $modelDetVocalia2A = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
                ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
                ->andWhere(['puede_jugar' => true])
                ->orderBy(['id_jugador' => SORT_ASC])
                ->all();

            $modelDetVocalia2B = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
                ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
                ->andWhere(['puede_jugar' => false])
                ->orderBy(['id_jugador' => SORT_ASC])
                ->all();

            foreach ($modelDetVocalia2A as $model) {
                $goles2A = $goles2A + ($model->goles ? $model->goles : 0);
            }
        }



        return $this->render('vocalia-partido', [
            'modelLigaBarrial' => $modelLigaBarrial,
            'modelCabFec' => $modelCabFec,
            'modelDetFec' => $modelDetFec,
            'modelCampeonato' => $modelCampeonato,
            'modelArbitros' => $modelArbitros,
            'modelEstadoVocalia' => $modelEstadoVocalia,
            'modelEquipos1' => $modelEquipos1,
            'modelEquipos2' => $modelEquipos2,
            'modelDetVocalia1A' => $modelDetVocalia1A,
            'modelDetVocalia2A' => $modelDetVocalia2A,
            'modelDetVocalia1B' => $modelDetVocalia1B,
            'modelDetVocalia2B' => $modelDetVocalia2B,
            'modelCabVocalia' => $modelCabVocalia,
            'goles1A' => $goles1A,
            'goles2A' => $goles2A,
            'idDetFec' => $idDetFec,

        ]);
    }
    public function actionVocaliaImagen($idDetFec)
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
            ->all();

        $modelJugadores2 = Jugador::find()
            ->where(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
            ->all();

        $modelCabVocalia = CabeceraVocalia::find()->where(['id_det_fecha' => $modelDetFec->id])->one();


        // 1A Y 2A = HABILITADOS PARA JUGAR
        $modelDetVocalia1A = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
            ->andWhere(['puede_jugar' => true])
            ->orderBy(['id_jugador' => SORT_ASC])
            ->all();

        $modelDetVocalia2A = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
            ->andWhere(['puede_jugar' => true])
            ->orderBy(['id_jugador' => SORT_ASC])
            ->all();

        //1B Y 2B  AMONESTADOS=SUSPENDIDOS
        $modelDetVocalia1B = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
            ->andWhere(['puede_jugar' => false])
            ->orderBy(['id_jugador' => SORT_ASC])
            ->all();


        $modelDetVocalia2B = DetalleVocalia::find()
            ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
            ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
            ->andWhere(['puede_jugar' => false])
            ->orderBy(['id_jugador' => SORT_ASC])
            ->all();

        $goles1A = 0;
        foreach ($modelDetVocalia1A as $model) {
            $goles1A = $goles1A + ($model->goles ? $model->goles : 0);
        }
        $goles2A = 0;
        foreach ($modelDetVocalia2A as $model) {
            $goles2A = $goles2A + ($model->goles ? $model->goles : 0);
        }


        if (!$modelDetVocalia1A) {

            foreach ($modelJugadores1 as $jugador) {
                $modelDetVocalia1 = new DetalleVocalia();
                $modelDetVocalia1->id_cabecera_vocalia = $modelCabVocalia->id;
                $modelDetVocalia1->ta = 0;
                $modelDetVocalia1->tr = 0;
                $modelDetVocalia1->goles = 0;
                $modelDetVocalia1->entrega_carnet = 0;
                $modelDetVocalia1->id_jugador = $jugador->id;
                $modelDetVocalia1->id_equipo = $jugador->id_equipo;
                $modelDetVocalia1->puede_jugar = $jugador->puede_jugar;
                $modelDetVocalia1->estado = $jugador->estado;
                $modelDetVocalia1->num_jugador = $jugador->num_camiseta . '';
                $modelDetVocalia1->nom_jugador = $jugador->nombres . ' ' . $jugador->apellidos;

                $modelDetVocalia1->save();
                // if(!$modelDetVocalia1->save())
                // {
                //     print_r($modelDetVocalia1->errors);
                //     die();
                // }

            }

            $modelDetVocalia1A = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
                ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
                ->andWhere(['puede_jugar' => true])
                ->orderBy(['id_jugador' => SORT_ASC])
                ->all();



            $modelDetVocalia1B = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
                ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo1->id_equipo])
                ->andWhere(['puede_jugar' => false])
                ->orderBy(['id_jugador' => SORT_ASC])
                ->all();



            foreach ($modelDetVocalia1A as $model) {
                $goles1A = $goles1A + ($model->goles ? $model->goles : 0);
            }
        }

        if (!$modelDetVocalia2A) {

            foreach ($modelJugadores2 as $jugador) {


                $modelDetVocalia2 = new DetalleVocalia();
                $modelDetVocalia2->id_cabecera_vocalia = $modelCabVocalia->id;
                $modelDetVocalia2->ta = 0;
                $modelDetVocalia2->tr = 0;
                $modelDetVocalia2->goles = 0;
                $modelDetVocalia2->entrega_carnet = 0;
                $modelDetVocalia2->id_jugador = $jugador->id;
                $modelDetVocalia2->id_equipo = $jugador->id_equipo;
                $modelDetVocalia2->puede_jugar = $jugador->puede_jugar;
                $modelDetVocalia2->estado = $jugador->estado;
                $modelDetVocalia1->num_jugador = $jugador->num_camiseta . '';
                $modelDetVocalia1->nom_jugador = $jugador->nombres . ' ' . $jugador->apellidos;

                $modelDetVocalia2->save();
            }
            $modelDetVocalia2A = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
                ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
                ->andWhere(['puede_jugar' => true])
                ->orderBy(['id_jugador' => SORT_ASC])
                ->all();

            $modelDetVocalia2B = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
                ->andWhere(['id_equipo' => $modelDetFec->grupoEquipo2->id_equipo])
                ->andWhere(['puede_jugar' => false])
                ->orderBy(['id_jugador' => SORT_ASC])
                ->all();

            foreach ($modelDetVocalia2A as $model) {
                $goles2A = $goles2A + ($model->goles ? $model->goles : 0);
            }
        }



        return $this->render('vocalia-imagenes', [
            'modelLigaBarrial' => $modelLigaBarrial,
            'modelCabFec' => $modelCabFec,
            'modelDetFec' => $modelDetFec,
            'modelCampeonato' => $modelCampeonato,
            'modelArbitros' => $modelArbitros,
            'modelEstadoVocalia' => $modelEstadoVocalia,
            'modelEquipos1' => $modelEquipos1,
            'modelEquipos2' => $modelEquipos2,
            'modelDetVocalia1A' => $modelDetVocalia1A,
            'modelDetVocalia2A' => $modelDetVocalia2A,
            'modelDetVocalia1B' => $modelDetVocalia1B,
            'modelDetVocalia2B' => $modelDetVocalia2B,
            'modelCabVocalia' => $modelCabVocalia,
            'goles1A' => $goles1A,
            'goles2A' => $goles2A,
            'idDetFec' => $idDetFec,

        ]);
    }

    public function actionEntregaCarnet()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $estado = Yii::$app->request->post('estado');

        // print_r('id:'.$id);
        // print_r('estado:'.$estado);
        // die();
        $model = DetalleVocalia::findOne($id);

        if ($model) {
            $model->entrega_carnet = $estado;
            if ($model->save()) {
                return ['success' => true];
            }
        }
        return ['success' => false];
    }
    public function actionActualizaGoles()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id'); // Recibimos el id
            $goles = Yii::$app->request->post('valor'); // Recibimos el valor    

            $model = DetalleVocalia::findOne($id); // Ajusta el modelo según tu lógica
            if ($model) {
                $golesAntes = $model->goles;
                $model->goles = $goles;
                if ($model->entrega_carnet && $model->save()) {
                    $this->sincronizaDatosJugadorAjaxUno($model, $golesAntes, $goles);
                    $modelCabVocalia = CabeceraVocalia::findOne($model->id_cabecera_vocalia);
                    //$this->sincronizaDetalleFechas($modelCabVocalia);
                    return ['success' => true, 'message' => 'Valor actualizado'];
                }
            }
            return ['success' => false, 'message' => 'No se pudo actualizar'];
        }
        return ['success' => false, 'message' => 'Método no permitido'];
    }
    public function actionCambioJugador()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id'); // Recibimos el id
            $cambio_x = Yii::$app->request->post('valor'); // Recibimos el valor    

            $model = DetalleVocalia::findOne($id); // Ajusta el modelo según tu lógica
            if ($model) {
                $model->num_jugador_cambio = $cambio_x;
                if ($model->entrega_carnet && $model->save()) {
                    return ['success' => true, 'message' => 'Valor actualizado'];
                }
            }
            return ['success' => false, 'message' => 'No se pudo actualizar'];
        }
        return ['success' => false, 'message' => 'Método no permitido'];
    }
    public function actionActualizaEstadoPartido()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $estado = Yii::$app->request->post('estado');

        $model = CabeceraVocalia::findOne($id);

        $modelEstPartido = HelperGeneral::devuelveIDEstadoFinalizadoPartido();

        if ($model) {
            $model->id_estado_vocalia = $estado;
            if ($model->save()) {
                if ($model->id_estado_vocalia == $modelEstPartido->valor1) //54=Finalizado, en tabla catalogos
                {
                    $this->sincronizaFinPartido($model);
                }
                return ['success' => true];
            }
        }

        return ['success' => false];
    }
    public function actionIniciarPartido()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $model = CabeceraVocalia::findOne($id);
        $timestamp = date('Y-m-d H:i:s'); // Formato compatible con PostgreSQL

        if ($model) {
            $model->hora_inicia = $timestamp; // O el estado que necesites
            if ($model->save(false)) {
                return ['success' => true];
            }
        }

        return ['success' => false];
    }


    public function sincronizaFinPartido($modelCabVocalia)
    {
        //sincroniza la suma de tarjetas, goles, 
        if ($modelCabVocalia) {
            //$this->sincronizaDatosJugador($modelCabVocalia);
            $this->sincronizaDetalleFechas($modelCabVocalia);
        }
    }
    public function sincronizaDetalleFechas($modelCabVocalia)
    {
        //sincroniza la suma de goles en detfecha
        if ($modelCabVocalia) {
            $modelDetFecha = DetalleFecha::findOne($modelCabVocalia->id_det_fecha);
            $goles1 = 0;
            $goles2 = 0;
            $ta1 = 0;
            $ta2 = 0;
            $tr1 = 0;
            $tr2 = 0;

            $modelDetVocalia = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id, 'id_equipo' => $modelCabVocalia->id_equipo_1])
                ->all();

            foreach ($modelDetVocalia as $model) {
                $goles1 = $goles1 + ($model->goles ? $model->goles : 0);
                $ta1 =  $ta1 + ($model->ta ? $model->ta : 0);
                $tr1 =  $tr1 + ($model->tr ? $model->tr : 0);
            }

            $modelDetVocalia = DetalleVocalia::find()
                ->where(['id_cabecera_vocalia' => $modelCabVocalia->id, 'id_equipo' => $modelCabVocalia->id_equipo_2])
                ->all();

            foreach ($modelDetVocalia as $model) {
                $goles2 = $goles2 + ($model->goles ? $model->goles : 0);
                $ta2 =  $ta2 + ($model->ta ? $model->ta : 0);
                $tr2 =  $tr2 + ($model->tr ? $model->tr : 0);
            }

            $modelDetFecha->goles_equipo2 = $goles2;
            $modelDetFecha->goles_equipo1 = $goles1;

            if ($goles1 > $goles2) {
                $modelDetFecha->ganador1 = 1;
                $modelDetFecha->ganador2 = 0;
            }
            if ($goles2 > $goles1) {
                $modelDetFecha->ganador1 = 0;
                $modelDetFecha->ganador2 = 1;
            }
            if ($goles2 == $goles1) {
                $modelDetFecha->ganador1 = 2;
                $modelDetFecha->ganador2 = 2;
            }

            $modelDetFecha->save();
            // die('zz');
        }
    }

    // public function sincronizaDatosJugador($modelCabVocalia)
    // {
    //     //sincroniza la suma de tarjetas, goles, del jugador
    //     if ($modelCabVocalia) {
    //         $modelDetVocalia = DetalleVocalia::find()
    //             ->where(['id_cabecera_vocalia' => $modelCabVocalia->id])
    //             ->all();

    //         foreach ($modelDetVocalia as $model) {
    //             if ($model->puede_jugar && $model->estado) {
    //                 if ($model->entrega_carnet) {
    //                     $jugador = Jugador::findOne($model->id_jugador);
    //                     if ($model->goles > 0) {
    //                         $jugador->goles = $model->goles + ($jugador->goles ? $jugador->goles : 0);
    //                     }
    //                     if ($model->ta > 0) {
    //                         $jugador->ta_actuales = $model->ta + ($jugador->ta_actuales ? $jugador->ta_actuales : 0);
    //                         $jugador->ta_acumuladas = $model->ta + ($jugador->ta_acumuladas ? $jugador->ta_acumuladas : 0);
    //                     }
    //                     if ($model->tr > 0) {
    //                         $jugador->tr_actuales = $model->tr + ($jugador->tr_actuales ? $jugador->tr_actuales : 0);
    //                         $jugador->tr_acumuladas = $model->tr + ($jugador->tr_acumuladas ? $jugador->tr_acumuladas : 0);
    //                     }
    //                     if (!$jugador->save()) {
    //                         echo '<pre>';
    //                         print_r($jugador->num_camiseta);
    //                         print_r($jugador->errors);
    //                         die();
    //                     }
    //                     // $jugador->save();

    //                 }
    //             }
    //         }
    //     }
    // }
    public function sincronizaDatosJugadorAjaxUno($modelDetVocalia, $golesAntes, $golesAhora)
    {
        $sumaGol = true;

        if ($golesAntes == $golesAhora) {

            return '';
        }
        if ($golesAntes > $golesAhora) {
            $sumaGol = false;
        }

        //sincroniza la suma de tarjetas, goles, del jugador


        $jugador = Jugador::findOne($modelDetVocalia->id_jugador);


        if ($sumaGol) {
            $jugador->goles = ($jugador->goles ? $jugador->goles : 0) + 1;
        } else {
            $jugador->goles = ($jugador->goles ? $jugador->goles : 0) - 1;
        }
        $jugador->save();
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
