<?php

namespace backend\controllers;

use common\models\Campeonato;
use common\models\DirectivaEquipos;
use common\models\Directivos;
use common\models\Equipo;
use common\models\Jugador;
use common\models\EquipoCategoria;
use Mpdf\Tag\Em;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use \yii\web\Response;
use yii\helpers\Html;
use common\models\Util\HelperGeneral;


/**
 * LigaBarrialController implements the CRUD actions for LigaBarrial model.
 */
class EquipoConfigController extends Controller
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
     * Lists all LigaBarrial models.
     * @return mixed
     */
    public function actionIndex()
    {         
       
        $request = Yii::$app->request;
        $modelListEquipos = Equipo::find()->all();
        $model= new Equipo();
       

        
           
            //$model->setAttribute('id', $request->post('Equipo')['id']);

            $modelCampeonato = Campeonato::find()
            ->where(['estado'=>1])
            ->one();
            //**catalogos */
            $modelListCategoria = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(21);	
	        $modelListGenero = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(17);
	        $modelListTipoDirectivos = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(1);


            //$sql = $modelEquipoCategoria->createCommand()->getRawSql();
            //$this->imprimeconDie($modelEquipoCategoria->);            

            $modelDirectivaEquipo = DirectivaEquipos::find()
            ->where(['id_equipo'=>$model->id])
            ->andWhere(['id_campeonato'=>$modelCampeonato->id])
            ->andWhere(['activo'=>1])
            ->all();

            //** directivos */
            $modelDirectivos = Directivos::find()
            ->where(['estado'=>1])
            ->all();
            
            /** Jugadores */
            $modelJugadores = null;//Jugador::find()->all();

            //$this->imprimeconDie($modelListEquipos);
            //$this->imprimeconDie($modelEquipoCategoria);
            // return $this->render('index', [
            //     'arrayListEquipos'=>ArrayHelper::map($modelListEquipos,'id','nombre') ,
            //     'modelListEquipos'=>$modelListEquipos,
            //     'listaJuagadores'=>'ok',
            //     'modelDirectivaEquipo'=>$modelDirectivaEquipo,
            //     'modelDirectivos'=>$modelDirectivos,
            //     'modelListCategoria'=>$modelListCategoria,
            //     'modelListGenero'=>$modelListGenero,
            //     'modelListTipoDirectivos'=>$modelListTipoDirectivos,
            //     'modelCampeonato'=>$modelCampeonato,
            //     'modelJugadores'=>$modelJugadores,
            //     'model' => $model,
            // ]);
              
            return $this->render('index', [
               'arrayListEquipos'=>ArrayHelper::map($modelListEquipos,'id','nombre') ,
               'modelListEquipos'=>$modelListEquipos,
               'listaJuagadores'=>null,              
               'modelDirectivaEquipo'=>null,
               'modelDirectivos'=>null,
               'modelListCategoria'=>null,
               'modelListGenero'=>null,
               'modelListTipoDirectivos'=>null,
               'modelCampeonato'=>null,
               'modelJugadores'=>null,
               'model' => $model,
           ]);
     

  
    }
    public function actionModalContenido($id_contenido,$id_equipo)
    {
        switch ($id_contenido) {
            case 1:
                $content = $this->contenidoCatGenero($id_equipo);
                break;
            case 2:
                $content = $this->contenidoDirectivos($id_equipo);
                break;
            case 3:
                $content = "Contenido del modal 3";
                break;
            // Puedes agregar más casos si es necesario
            default:
                $content = "Contenido por defecto o no encontrado";
                break;
        }

    return $content; // O podrías renderizar una vista parcial si lo prefieres
    }
    
    public function contenidoCatGenero($id)
    {
        $modelEquipo = Equipo::find()->where(['id'=>$id])->one();
        $modelCampeonato = Campeonato::find()
            ->where(['estado'=>1])
            ->one();
        //**catalogos */
        $modelListCategoria = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(21);	
	    $modelListGenero = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(17);
	    $modelListTipoDirectivos = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(1);

        //** equipo - categoria */
        $modelEquipoCategoria = EquipoCategoria::find()
            ->where(['id_equipo'=>$modelEquipo->id])          
            ->all();

        // Renderizamos una vista parcial (sin layout)
        return $this->renderAjax('categoria-genero', [
            // Pasamos datos si es necesario
            'modelEquipoCategoria' => $modelEquipoCategoria,
			'modelListCategoria'=>$modelListCategoria,
			'modelListGenero'=>$modelListGenero,
			'modelEquipo'=>$modelEquipo,
        ]);
    }
    public function contenidoDirectivos($id)
    {
        $modelEquipo = Equipo::find()->where(['id'=>$id])->one();
        $modelCampeonato = Campeonato::find()
            ->where(['estado'=>1])
            ->one();
        //**catalogos */
        $modelListCategoria = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(21);	
	    $modelListGenero = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(17);
	    $modelListTipoDirectivos = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(1);

        //** equipo - categoria */
        $modelEquipoCategoria = EquipoCategoria::find()
            ->where(['id_equipo'=>$modelEquipo->id])          
            ->all();

        // Renderizamos una vista parcial (sin layout)
        return $this->renderAjax('categoria-genero', [
            // Pasamos datos si es necesario
            'modelEquipoCategoria' => $modelEquipoCategoria,
			'modelListCategoria'=>$modelListCategoria,
			'modelListGenero'=>$modelListGenero,
			'modelEquipo'=>$modelEquipo,
        ]);
    }

    /** Acciones utilizadas en Ajax */

    public function actionAsignaCategoriaGenero()
    {
        $request = Yii::$app->request;

        $id_categoria = $request->get('id_categoria');
        $id_genero =$request->get('id_genero');
        $id_equipo = $request->get('id_equipo');
       
        $model = New EquipoCategoria();
        $model->id_categoria = $id_categoria;
        $model->id_genero = $id_genero;
        $model->id_equipo = $id_equipo;
        $model->estado = true;
        if ($model->save())
        {
            return json_encode(['resp'=>'1']);
        }

        return json_encode(['resp'=>'0']);  
    }    
    public function actionAsignaDirectivo()
    {
        $request = Yii::$app->request;
        $modelCampeonato = Campeonato::find()
        ->where(['estado'=>1])
        ->one();

        $id_directivo = $request->get('id_directivo');
        $id_tipo_directivo = $request->get('id_tipo_directivo');
        $id_equipo = $request->get('id_equipo');
       
        $model = New DirectivaEquipos();
        $model->code = "-";
        $model->id_directivo = $id_directivo;
        $model->id_tipo_directivo = $id_tipo_directivo;      
        $model->id_equipo = $id_equipo;
        $model->id_campeonato = $modelCampeonato->id;
        $model->activo = 1;
        

        if ($model->save())
        {
            return json_encode(['resp'=>'1']);
        }

        return json_encode(['resp'=>'0']);  
    }
    

    private function imprimeconDie($var)    
    {
        echo '<pre>';
        print_r($var);        
        die(); 
    }
    private function imprime($var)    
    {
        echo '<pre>';
        print_r($var);        
    }


}