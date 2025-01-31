<?php

namespace backend\controllers;

use Yii;
use common\models\GrupoEquipo;
use common\models\Grupos;
use common\models\search\GrupoEquipoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * GrupoEquipoController implements the CRUD actions for GrupoEquipo model.
 */
class GrupoEquipoController extends Controller
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
     * Lists all GrupoEquipo models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new GrupoEquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndex1()
    {
        /*FC: 2023-05-19    CP: Santiago C      FM:         MP
        Note: Esta accion, es llamada para realizar el filtro en el GRID de GRUPOS, muestra las imagenes asociadas
        */    

        if (isset($_POST['expandRowKey'])) {
            // echo '<pre>';
            // var_dump('hola');
            // die();
            $searchModel = new GrupoEquipoSearch();
            $dataProvider = $searchModel->searchGrupoEquipo(Yii::$app->request->queryParams,$_POST['expandRowKey']);

            return $this->renderPartial('_listado-grupos', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id_equipo'=>$_POST['expandRowKey'],
            ]);

        } else {
            return '<div class="alert alert-danger">Datos no Encontrados</div>';
        }
    }

    /**
     * Displays a single GrupoEquipo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $modelGrupoEquipo = GrupoEquipo::findOne($id);
            return [
                    'title'=>'<b>Sección:</b> <span style="color:red"> '. $modelGrupoEquipo->grupo->catalogo->valor.'</span>',
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
     * Creates a new GrupoEquipo model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_grupo)
    {     
        
        $request = Yii::$app->request;
        $model = new GrupoEquipo();  
        $model->id_grupo = $id_grupo;
         
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
        // echo '<pre>';
        // print_r($id_grupo);
        // die();
                return [
                    'title'=> "Crear Nuevo Grupo",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->validate() ){

                //revisamos si ya existe el equipo, en algun otro grupo, del mismo campeonato, de la misma etapa

                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Crear Nuevo Grupo",
                    'content'=>'<span class="text-success">Create GrupoEquipo success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"])
                            //Html::a('Crear Nuevo',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Crear Nuevo Grupo",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Crear Nuevo',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
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
     * Updates an existing GrupoEquipo model.
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
                    'title'=> "Update GrupoEquipo #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "GrupoEquipo #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update GrupoEquipo #".$id,
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
     * Delete an existing GrupoEquipo model.
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
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing GrupoEquipo model.
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
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the GrupoEquipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GrupoEquipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GrupoEquipo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function revisa_equipo_duplicado_en_grupo($model_grupo_equipo)
    {        
        $modelGrupoEquipo = GrupoEquipo::find()
        ->where(['id_campeonato'=>$model_grupo_equipo->id_campeonato])
        ->andWhere(['id_grupo'=>$model_grupo_equipo->id_grupo])
        ->andWhere(['id_equipo'=>$model_grupo_equipo->id_equipo])
        ->one();
        if ($modelGrupoEquipo)
        {
            return false;
        }

        return true;
    }
    private function revisa_equipo_duplicado_en_etapa($model_grupo_equipo)
    {        
        $modelGrupoEquipos = GrupoEquipo::find()
        ->where(['id_campeonato'=>$model_grupo_equipo->id_campeonato])      
        ->andWhere(['id_equipo'=>$model_grupo_equipo->id_equipo])
        ->all();

        // $modelGrupos = Grupos::find()
        // ->where(['id_campeonato'=>$model_grupo_equipo->id_campeonato])
        // ->all();

        // foreach($modelGrupoEquipos as $model1)
        // {
        //     if()
        //     {

        //     }
        // }

        return true;
    }
}
