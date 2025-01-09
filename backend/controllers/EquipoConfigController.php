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
use yii\helpers\VarDumper;

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
        $modelListEquipos = Equipo::find()->all();
        $model = new Equipo();
        //$model->setAttribute('id', $request->post('Equipo')['id']);          

        return $this->render('index', [
            'arrayListEquipos' => ArrayHelper::map($modelListEquipos, 'id', 'nombre'),
            'modelListEquipos' => $modelListEquipos,
            'model' => $model,
        ]);
    }

    public function actionModalContenido($id_contenido, $id_equipo)
    {
        $request = Yii::$app->request;     
        
        switch ($id_contenido) {
            case 1:
                // Yii::$app->response->format = Response::FORMAT_JSON;
                // return [
                //     'title'=> "Crear Nuevo Jugador",
                //     'content'=>$this->contenidoCatGenero($id_equipo),
                //     'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                //                 Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                // ]; 
                $content = $this->contenidoCatGenero($id_equipo);
                break;
            case 2:
                $content = $this->contenidoDirectivos($id_equipo);
                break;
            case 3:
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'title'=> "Crear Nuevo Jugador",
                    'content'=>$this->contenidoJugadores($id_equipo),
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

    public function actionCreateJugador()
    {
        $request = Yii::$app->request;

        $modelJugador = new Jugador();
        $modelJugador->load($request->post('Jugador'),'');
        $idCatGenero = $request->post('ddl_genero');
        $this->imprimeconDie($modelJugador->attributes);

        if($modelJugador->load($request->post()) && $modelJugador->save()){
            return [
                'forceReload'=>'#crud-datatable-pjax',
                'title'=> "Crear Nuevo Jugador",
                'content'=>'<span class="text-success">Creación Jugador Exitosa</span>',
                'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::a('Crear Nuevo',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])    
            ];         
        }else{           
            return [
                'title'=> "Crear Nuevo Jugador",
                'content'=>$this->renderAjax('create', [
                    'model' => $modelJugador,
                ]),
                'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
    
            ];         
        }    
    }
    /**************************************************************************************** */

    public function contenidoCatGenero($id)
    {
        $modelEquipo = Equipo::find()->where(['id' => $id])->one();
        //**catalogos */
        $modelListCategoria = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(21);
        $modelListGenero = HelperGeneral::obtenerListaCatalogoPorIdCatalogo(17);

        $modelCampeonato = Campeonato::find()->where(['estado' => 1])->one();

        //** equipo - categoria */
        $modelEquipoCategoria = EquipoCategoria::find()
            ->where(['id_equipo' => $modelEquipo->id])
            ->all();


        // Renderizamos una vista parcial (sin layout)
        return $this->renderAjax('categoria-genero', [
            // Pasamos datos si es necesario
            'modelEquipoCategoria' => $modelEquipoCategoria,
            'modelListCategoria' => $modelListCategoria,
            'modelListGenero' => $modelListGenero,
            'modelEquipo' => $modelEquipo,
            'modelCampeonato' => $modelCampeonato,
        ]);
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

        $modelDirectivaEquipo = DirectivaEquipos::find()
            ->where(['id_equipo' => $id])
            ->andWhere(['id_campeonato' => $modelCampeonato->id])
            ->andWhere(['activo' => 1])
            ->all();

        //** directivos */
        $modelDirectivos = Directivos::find()
            ->where(['estado' => 1])
            ->all();

        return $this->renderAjax('directivos', [
            'modelDirectivaEquipo' => $modelDirectivaEquipo,
            'modelDirectivos' => $modelDirectivos,
            'modelListCategoria' => $modelListCategoria,
            'modelListTipoDirectivos' => $modelListTipoDirectivos,
            'modelCampeonato' => $modelCampeonato,
            'modelEquipo' => $modelEquipo,
        ]);
    }
    public function contenidoJugadores($id)
    {
        //$model->setAttribute('id', $request->post('Equipo')['id']);
        $modelEquipo = Equipo::find()->where(['id' => $id])->one();
        $modelCampeonato = Campeonato::find()->where(['estado' => 1])->one();

        /** Jugadores */
        $modelJugadores = Jugador::find()->all();
        //** equipo - categoria */
        $modelEquipoCategoria = EquipoCategoria::find()
            ->where(['id_equipo' => $modelEquipo->id])
            ->all();

        return $this->renderAjax('jugadores', [
            'modelJugadores' => $modelJugadores,
            'modelCampeonato' => $modelCampeonato,
            'modelEquipo' => $modelEquipo,
            'modelEquipoCategoria'=>$modelEquipoCategoria,
        ]);
    }

    /** Acciones utilizadas en Ajax */

    public function actionAsignaCategoriaGenero()
    {
        $request = Yii::$app->request;

        $id_categoria = $request->get('id_categoria');
        $id_genero = $request->get('id_genero');
        $id_equipo = $request->get('id_equipo');

        $model = new EquipoCategoria();
        $model->id_categoria = $id_categoria;
        $model->id_genero = $id_genero;
        $model->id_equipo = $id_equipo;
        $model->estado = true;
        if ($model->save()) {
            return json_encode(['resp' => '1']);
        }

        return json_encode(['resp' => '0']);
    }
    public function actionAsignaDirectivo()
    {
        $request = Yii::$app->request;
        $modelCampeonato = Campeonato::find()
            ->where(['estado' => 1])
            ->one();

        $id_directivo = $request->get('id_directivo');
        $id_tipo_directivo = $request->get('id_tipo_directivo');
        $id_equipo = $request->get('id_equipo');

        $model = new DirectivaEquipos();
        $model->code = "-";
        $model->id_directivo = $id_directivo;
        $model->id_tipo_directivo = $id_tipo_directivo;
        $model->id_equipo = $id_equipo;
        $model->id_campeonato = $modelCampeonato->id;
        $model->activo = 1;


        if ($model->save()) {
            return json_encode(['resp' => '1']);
        }

        return json_encode(['resp' => '0']);
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
