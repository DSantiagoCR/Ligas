<?php

namespace backend\controllers;

use common\models\CabeceraFechas;
use common\models\Catalogos;
use Yii;
use common\models\DetalleFecha;
use common\models\GrupoEquipo;
use common\models\Grupos;
use common\models\search\DetalleFechaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * DetalleFechaController implements the CRUD actions for DetalleFecha model.
 */
class DetalleFechaController extends Controller
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


    /**
     * Lists all DetalleFecha models.
     * @return mixed
     */
    public function actionIndex1()
    {
        if (isset($_POST['expandRowKey'])) {
            // echo '<pre>';
            // var_dump('hola');
            // die();
            $searchModel = new DetalleFechaSearch();
            $dataProvider = $searchModel->searchDetalleFechas(Yii::$app->request->queryParams, $_POST['expandRowKey']);

            return $this->renderPartial('_listado-fechas', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id_cabFechas' => $_POST['expandRowKey'],
            ]);
        } else {
            return '<div class="alert alert-danger">Datos no Encontrados</div>';
        }
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
                'title' => "Detalle Fecha",
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                    Html::a('Editar', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
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
    public function actionCreate($id_cabFechas)
    {
        $request = Yii::$app->request;
        $model = new DetalleFecha();
        $model->id_cabecera_fecha = $id_cabFechas;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Detalle Fechas",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->validate()) {
                $alert1 = $alert2 = $alert3 = $alert4 = $alert5 = true;
               
                if (!$this->verifica_det_fecha_equipos($model)) {
                    Yii::$app->session->setFlash('A1', 'No se puede configurar dos veces el mismo EQUIPO en el mismo DIA');
                    $alert1 = false;
                }
                if (!$this->verifica_det_fecha_hora_partido($model)) {
                    Yii::$app->session->setFlash('A1', 'No se puede configurar dos veces la misma HORA en el mismo DIA');
                    $alert2 = false;

                }
                if ($alert1 and $alert2 and $alert3 and $alert4 and $alert5) {
                    //verifica quien es el ganador
                    
                    $model->goles_equipo1 =0;
                    $model->goles_equipo2=0;
                    $model->save();
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Detalle Fechas",
                        'content' => '<span class="text-success">Registro Creado Corrctamente</span>',
                        'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                            Html::a('Crear Nuevo', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                    ];
                } else {
                    return [
                        'title' => "Detalle Fechas",
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                            Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])

                    ];
                }
            } else {
                return [
                    'title' => "Detalle Fechas",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])

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
                    'title' => "Actualizar Detalle Fecha",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->validate()) {
               
                if($model->goles_equipo1 > $model->goles_equipo2){
                    $model->ganador1=1;
                    $model->ganador2=0;                        
                }
                if($model->goles_equipo1 < $model->goles_equipo2){
                    $model->ganador1=0;
                    $model->ganador2=1;                        
                }
                if($model->goles_equipo1 == $model->goles_equipo2){
                    $model->ganador1=2;
                    $model->ganador2=2;                        
                }
                $model->save();
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' =>  "Actualizar Detalle Fecha",
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::a('Editar', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Actualizar Detalle Fecha",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])
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

    public function actionBusquedaEtapaGrupo()
    {
        $request = Yii::$app->request;
        $id_etapa =  $request->post('id_etapa1');
        $Grupos = Grupos::find()->where(['id_catalogo' => $id_etapa])->all();
        $data = [];
        foreach ($Grupos as $subcategoria) {
            $data[] = [
                'id' => $subcategoria->id, 
                'name' => $subcategoria->nombre.' - '.$subcategoria->genero->valor.' - '.$subcategoria->categoria->valor];
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
        //return json_encode($data);
    }
    public function actionBusquedaGrupoEquipo1()
    {
        $request = Yii::$app->request;
        $id_grupo =  $request->post('id_grupo1');        

        $modelDF = DetalleFecha::find()
        ->where(['id_grupo'=>$id_grupo])
        ->all();

        $dataDF = [];
        foreach ($modelDF as $dato) {
            $dataDF[] = $dato->grupoEquipo1->id_equipo;
            $dataDF[] = $dato->grupoEquipo2->id_equipo;            
        }

        $GruposEquipo = GrupoEquipo::find()
        ->where(['id_grupo' => $id_grupo])
        ->andWhere(['not in','id_equipo',$dataDF])
        ->all();

        $data = [];
        foreach ($GruposEquipo as $subcategoria) {
            $data[] = ['id' => $subcategoria->id, 'name' => $subcategoria->equipo->nombre];
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
        //return json_encode($data);
    }
    public function actionBusquedaGrupoEquipo2()
    {
        $request = Yii::$app->request;
        $id_grupo_equipo1 =  $request->post('id_grupo_equipo1');

        $GruposEquipo = GrupoEquipo::find()->where(['id' => $id_grupo_equipo1])->one(); 
        
        $modelDF = DetalleFecha::find()
        ->where(['id_grupo'=> $GruposEquipo->id_grupo])
        ->all();

        $dataDF = [];
        foreach ($modelDF as $dato) {
            $dataDF[] = $dato->grupoEquipo1->id_equipo;
            $dataDF[] = $dato->grupoEquipo2->id_equipo;            
        } 

        $dataDF[] = $GruposEquipo->id_equipo;

        $GruposEquipos = GrupoEquipo::find()
            ->where(['id_grupo' => $GruposEquipo->id_grupo])
            //->andWhere(['<>', 'id_equipo', $GruposEquipo->id_equipo]);
            ->andWhere(['not in','id_equipo',$dataDF])
            ->all();
            // print_r($GruposEquipos->createCommand()->getRawSql());
            // die();
 

        $data = [];
        foreach ($GruposEquipos as $subcategoria) {
            $data[] = ['id' => $subcategoria->id, 'name' => $subcategoria->equipo->nombre];
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
        //return json_encode($data);
    }
    public function actionBusquedaHorasInicio()
    {
        $request = Yii::$app->request;
        $id_grupo =  $request->post('id_grupo');
        $id_cab_fechas =  $request->post('id_cab_fechas');
        // echo '<pre>';
        // print_r(   $id_cab_fechas  );
        // DIE();

        //$modelCabFechas = CabeceraFechas::findOne( $id_cab_fechas);
        $modelDF = DetalleFecha::find()
        ->where(['id_cabecera_fecha'=> $id_cab_fechas])
        ->andWhere(['id_estado_partido'=>51])
        ->all();        
    
        $dataDF = [];
        foreach ($modelDF as $dato) {
            $dataDF[] = $dato->hora_inicio;         
        }      

        $horasPartidos = Catalogos::find()
            ->where(['id_catalogo' => 56])           
            ->andWhere(['not in','id',$dataDF])
            ->all();           

        $data = [];
        foreach ($horasPartidos as $data1) {
            $data[] = ['id' => $data1->id, 'name' => $data1->valor];
        }
     

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
        //return json_encode($data);
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

    private function verifica_det_fecha_equipos($modelDetFec)
    {
        //metodo que verifica que no se repita en grupo, el equipo

        $modelDF1 = DetalleFecha::find()
            ->where(['id_cabecera_fecha' => $modelDetFec->id_cabecera_fecha])
            ->andWhere(['id_grupo_equipo1' => $modelDetFec->id_grupo_equipo1])
            ->one();

        $modelDF2 = DetalleFecha::find()
            ->where(['id_cabecera_fecha' => $modelDetFec->id_cabecera_fecha])
            ->andWhere(['id_grupo_equipo2' => $modelDetFec->id_grupo_equipo2])
            ->one();


        if ($modelDF1) {
            return false;
        }
        if ($modelDF2) {
            return false;
        }
        return true;
    }
    private function verifica_det_fecha_hora_partido($modelDetFec)
    {
        //metodo que no se repita la hora para los partidos en la misma fecha

        $modelDF1 = DetalleFecha::find()
            ->where(['id_cabecera_fecha' => $modelDetFec->id_cabecera_fecha])
            ->andWhere(['hora_inicio' => $modelDetFec->hora_inicio])
            ->one();

        if ($modelDF1) {
            return false;
        }
        return true;
    }
}
