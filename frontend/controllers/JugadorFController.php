<?php

namespace frontend\controllers;

use yii\web\UploadedFile;
use Yii;
use common\models\Jugador;
use common\models\search\JugadorSearch;
use common\models\UserEquipo;
use common\models\Util\ImageCrud;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * JugadorFController implements the CRUD actions for Jugador model.
 */
class JugadorFController extends Controller
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
    public function actionIndex($id)
    {
        // print_r($id);
        // die();

        $modelUE = UserEquipo::findOne($id);
        $searchModel = new JugadorSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $modelUE->id_equipo);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelUE' => $modelUE
        ]);
    }


    /**
     * Displays a single Jugador model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Jugador",
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
     * Creates a new Jugador model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_equipo)
    {
        $request = Yii::$app->request;
        $model = new Jugador();
        $model->id_equipo = $id_equipo;
        $model->estado = false;
        $model->puede_jugar = false;
        $model->hijos = '0';
        $objImagenCrud = new ImageCrud();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {

                return [
                    'title' => "Crear Jugador",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {

                if(UploadedFile::getInstance($model, 'link_foto'))
                {
                    $imagen = UploadedFile::getInstance($model, 'link_foto');
                    $pathServer = Yii::getAlias('@webroot').'/img/jugadores/';
                    $path = '/img/jugadores/';

                    // $pathServer = Yii::getAlias('@webroot').'/uploads/jugadores/';
                    // $pathServer = str_replace('/frontend/web', '', $pathServer);                   
                    // $path = '/uploads/jugadores/';
                    $model->link_foto = $path.$imagen->name;   
                                     
                }   
             
                if ($model->validate() && $model->save()) { // Guardar sin validación adicional
                    if(!$objImagenCrud->almacenaImagen($model,'link_foto',$pathServer,$path))
                    {
                        Yii::$app->session->setFlash('imagenCabinError', "La imagen no puedo subir al servidor, consulte con el Administrador");
                    }

                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Crear Jugador",
                        'content' => '<span class="text-success">Create Jugador success</span>',
                        'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                            Html::a('Create Nuevo', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                    ];
                }
                else
                {
                    return [
                        'title' => "Crear Jugador",
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                            Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])
    
                    ];
                }
            } else {
                return [
                    'title' => "Crear Jugador",
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
     * Updates an existing Jugador model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $objImagenCrud = new ImageCrud();
        $pathServer = '';
        $path = '';

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Actualizar Jugador",
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {

                $existeImagen = false;
                if(UploadedFile::getInstance($model, 'link_foto'))
                {
                    $imagen = UploadedFile::getInstance($model, 'link_foto');
                    $pathServer = Yii::getAlias('@webroot').'/img/jugadores/';
                    $path = '/img/jugadores/';

                    // $pathServer = Yii::getAlias('@webroot').'/uploads/jugadores/';
                    // $pathServer = str_replace('/frontend/web', '', $pathServer);                   
                    // $path = '/uploads/jugadores/';
                    $model->link_foto = $path.$imagen->name; 
                    $existeImagen = true;  
                                     
                }               
                if ($model->validate() && $model->save()) { 
                    if($existeImagen)
                    {
                        if(!$objImagenCrud->almacenaImagen($model,'link_foto',$pathServer,$path))
                        {
                            Yii::$app->session->setFlash('imagenCabinError', "La imagen no puedo subir al servidor, consulte con el Administrador");
                        }
                    }
                   
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Jugador",
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                            Html::a('Editar', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }
                else
                {
                    return [
                        'title' => "Actualizar Jugador",
                        'content' => $this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Cerrar', ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => "modal"]) .
                            Html::button('Guardar', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                }
            } else {
                return [
                    'title' => "Actualizar Jugador",
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
     * Delete an existing Jugador model.
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
     * Delete multiple existing Jugador model.
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

    /**
     * Finds the Jugador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jugador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jugador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
