<?php

namespace backend\controllers;

use common\models\Campeonato;
use common\models\Directivos;
use Yii;
use common\models\Equipo;
use common\models\search\EquipoSearch;
use common\models\Util\HelperGeneral;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * EquipoController implements the CRUD actions for Equipo model.
 */
class EquipoController extends Controller
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
     * Lists all Equipo models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndex1()
    {
       
        return $this->render('index1');
    }



    /**
     * Displays a single Equipo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Equipo ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Equipo model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Equipo();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Equipo",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Crear Nuevo Equipo",
                    'content'=>'<span class="text-success">Creación Equipo Exitosa</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Crear Nuevo',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Crear Equipo",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
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
     * Updates an existing Equipo model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Actualizar Equipo ",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Equipo ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Actualizar Equipo ",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
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
     * Delete an existing Equipo model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceCerrar'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Equipo model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceCerrar'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    public function actionModalContenido($id)
    {
        $request = Yii::$app->request;     
        $id_contenido =2;
        switch ($id_contenido) {
            case 1:
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'title'=> "Crear Nuevo Jugador",
                    'content'=>$this->contenidoCatGenero($id),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ]; 
                //$content = $this->contenidoCatGenero($id);
              
                break;
            case 2:
                $content = $this->contenidoDirectivos($id);
                break;
            case 3:
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'title'=> "Crear Nuevo Jugador",
                    'content'=>$this->contenidoJugadores($id),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                                //Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];
                //$content = $this->contenidoJugadores($id_equipo);
                break;
                // Puedes agregar más casos si es necesario
            default:
                //$content = "Contenido por defecto o no encontrado";
                $content = $this->renderPartial('default', [
                    'message' => 'Contenido no encontrado',
                ]);
                break;
        }

        return $content; // O podrías renderizar una vista parcial si lo prefieres
    }
 

    /**
     * Finds the Equipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function contenidoDirectivos($id)
    {
        //$model->setAttribute('id', $request->post('Equipo')['id']);
        $modelEquipo = Equipo::find()->where(['id' => $id])->one();
        $modelCampeonato = Campeonato::find()
            ->where(['estado' => 1])
            ->one();
        //**catalogos */
        $modelListCategoria = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(21);
        $modelListTipoDirectivos = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(1);

        //** directivos */
        $modelDirectivos = Directivos::find()
            ->where(['estado' => 1])
            ->all();

        return $this->renderAjax('directivos', [
            'modelDirectivos' => $modelDirectivos,
            'modelListCategoria' => $modelListCategoria,
            'modelListTipoDirectivos' => $modelListTipoDirectivos,
            'modelCampeonato' => $modelCampeonato,
            'modelEquipo' => $modelEquipo,
        ]);
    }
    public function contenidoCatGenero($id)
    {
        $modelEquipo = Equipo::find()->where(['id' => $id])->one();
        //**catalogos */
        $modelListCategoria = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(21);
        $modelListGenero = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(17);

        $modelCampeonato = Campeonato::find()->where(['estado' => 1])->one();

        // Renderizamos una vista parcial (sin layout)
        return $this->renderAjax('categoria-genero', [
            // Pasamos datos si es necesario
            'modelListCategoria' => $modelListCategoria,
            'modelListGenero' => $modelListGenero,
            'modelEquipo' => $modelEquipo,
            'modelCampeonato' => $modelCampeonato,
        ]);
    }
}
