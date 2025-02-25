<?php

namespace frontend\controllers;

use common\models\UserEquipo;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class PrincipalController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($id, $submenu = null)
    {
        // $this->imprimirDie($id);
        $modelUE = UserEquipo::findOne($id);

        // $this->imprimirDie($modelUE);
        return $this->render(
            'index',
            [
                'modelUE' => $modelUE,
                'submenu' => $submenu
            ]
        );
    }

    public function actionSeleccion($indice,$id_user_equipo)
    {
        $submenu = "";

        switch ($indice) {
            case 1:
                $submenu = '/jugador/index';
                break;

            case 2:
                echo "El color es azul";
                break;

            case 3:
                echo "El color es verde";
                break;

            default:
                echo "Color no reconocido";
        }

        return $this->redirect(['index', 'id' => $id_user_equipo, 'submenu' => $submenu]);       
     
    }

    private function imprimirDie($dato)
    {
        echo '<pre>';
        print_r($dato);
        die();
    }
}
