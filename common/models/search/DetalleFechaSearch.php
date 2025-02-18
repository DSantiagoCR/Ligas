<?php

namespace common\models\search;

use common\models\Campeonato;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DetalleFecha;

/**
 * DetalleFechaSearch represents the model behind the search form about `\common\models\DetalleFecha`.
 */
class DetalleFechaSearch extends DetalleFecha
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_cabecera_fecha', 'id_grupo', 'id_grupo_equipo1', 'id_grupo_equipo2', 'goles_equipo1', 'goles_equipo2', 'id_estado_partido','id_etapa'], 'integer'],
            [['hora_inicio'], 'safe'],
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
    public function search($params)
    {
        $query = DetalleFecha::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_cabecera_fecha' => $this->id_cabecera_fecha,
            'id_grupo' => $this->id_grupo,
            'id_grupo_equipo1' => $this->id_grupo_equipo1,
            'id_grupo_equipo2' => $this->id_grupo_equipo2,
            'goles_equipo1' => $this->goles_equipo1,
            'goles_equipo2' => $this->goles_equipo2,
            'id_estado_partido' => $this->id_estado_partido,
            'estado' => $this->estado,
            'id_etapa' => $this->id_etapa, 
        ]);

        $query->andFilterWhere(['like', 'hora_inicio', $this->hora_inicio]);

        return $dataProvider;
    }
    public function searchDetalleFechas($params,$id_cabFechas=null)
    {
      
       $query = DetalleFecha::find()
        ->where(['id_cabecera_fecha'=>$id_cabFechas]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
  
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
    
        $query->andFilterWhere([
            'id' => $this->id,
            'id_cabecera_fecha' => $this->id_cabecera_fecha,
            'id_grupo' => $this->id_grupo,
            'id_grupo_equipo1' => $this->id_grupo_equipo1,
            'id_grupo_equipo2' => $this->id_grupo_equipo2,
        ]);
        
        $query->andFilterWhere(['like', 'id_cabecera_fecha', $this->id_cabecera_fecha])
            ->andFilterWhere(['like', 'id_grupo', $this->id_grupo])
            ->andFilterWhere(['like', 'id_grupo_equipo1', $this->id_grupo_equipo1])
            ->andFilterWhere(['like', 'id_grupo_equipo2', $this->id_grupo_equipo2]);

        $query->orderBy(['hora_inicio'=>SORT_ASC]);

        return $dataProvider;
    }
}
