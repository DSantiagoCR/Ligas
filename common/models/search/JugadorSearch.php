<?php

namespace common\models\search;

use common\models\Campeonato;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Jugador;
use DateTime;
use PHPUnit\Framework\Constraint\IsNull;

/**
 * JugadorSearch represents the model behind the search form about `common\models\Jugador`.
 */
class JugadorSearch extends Jugador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_estado_civil', 'hijos', 'id_equipo', 'num_camiseta', 'puede_jugar'], 'integer'],
            [['code', 'nombres', 'apellidos', 'fecha_nacimiento', 'cedula', 'celular', 'num_camiseta'], 'safe'],
            [['estado'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $idUserEquipo = null)
    {
        $modelsCampeonato = Campeonato::find()->where(['estado' => true])->one();

        $query = Jugador::find()->where(['id_campeonato'=>$modelsCampeonato->id]);
        if ($idUserEquipo) {

            $query = Jugador::find()
                ->where(['id_equipo' => $idUserEquipo,'id_campeonato'=>$modelsCampeonato->id]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50, // Número de registros por página
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if ($this->fecha_nacimiento != '') {
            if (!$this->validarFecha($this->fecha_nacimiento ?? null)) {
                $this->fecha_nacimiento = null; //date('Y-m-d');
            }
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'id_estado_civil' => $this->id_estado_civil,
            'hijos' => $this->hijos,
            'estado' => $this->estado,
            'id_equipo' => $this->id_equipo,
            'num_camiseta' => $this->num_camiseta,
            'puede_jugar' => $this->puede_jugar,

        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'upper(nombres)', strtoupper(($this->nombres ?? ''))])
            ->andFilterWhere(['like', 'upper(apellidos)', strtoupper($this->apellidos ?? '')])
            ->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like', 'celular', $this->celular]);

        return $dataProvider;
    }
  
    private function validarFecha($fecha, $formato = 'Y-m-d')
    {
        if ($fecha == null) {
            return false;
        }
        $d = DateTime::createFromFormat($formato, $fecha);
        return $d && $d->format($formato) === $fecha;
    }
    // public function searchFront($params,$idUserEquipo)
    // {
    //     // echo '<pre>';
    //     // print_r($params);
    //     // die();
    //     $query = Jugador::find()
    //     ->where(['id_equipo'=>$idUserEquipo]);

    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //     ]);

    //     $this->load($params);

    //     if (!$this->validate()) {
    //         // uncomment the following line if you do not want to return any records when validation fails
    //         // $query->where('0=1');
    //         return $dataProvider;
    //     }
    //     if($this->fecha_nacimiento!='')
    //     {
    //         if(!$this->validarFecha($this->fecha_nacimiento??null))
    //         {
    //             $this->fecha_nacimiento = null; //date('Y-m-d');
    //         }
    //     }


    //     $query->andFilterWhere([
    //         'id' => $this->id,
    //         'fecha_nacimiento' => $this->fecha_nacimiento,
    //         'id_estado_civil' => $this->id_estado_civil,
    //         'hijos' => $this->hijos,
    //         'estado' => $this->estado,
    //         'id_equipo' => $this->id_equipo,
    //         'puede_jugar' => $this->puede_jugar,
    //         'num_camiseta' => $this->num_camiseta,
    //     ]);

    //     $query->andFilterWhere(['like', 'code', $this->code])
    //         ->andFilterWhere(['like', 'upper(nombres)', strtoupper(($this->nombres??''))])
    //         ->andFilterWhere(['like', 'upper(apellidos)', strtoupper($this->apellidos??'')])
    //         ->andFilterWhere(['like', 'cedula', $this->cedula])
    //         ->andFilterWhere(['like', 'celular', $this->celular]);

    //     return $dataProvider;
    // }
}
