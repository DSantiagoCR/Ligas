<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CabeceraFechas;

/**
 * CabeceraFechasSearch represents the model behind the search form about `\common\models\CabeceraFechas`.
 */
class CabeceraFechasSearch extends CabeceraFechas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_campeonato', 'id_estado_fecha'], 'integer'],
            [['dia', 'fecha'], 'safe'],
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
        $query = CabeceraFechas::find();

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
            'fecha' => $this->fecha,
            'id_campeonato' => $this->id_campeonato,
            'id_estado_fecha' => $this->id_estado_fecha,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'dia', $this->dia]);

        $query->orderBy(['fecha'=>SORT_ASC]);

        return $dataProvider;
    }
}
