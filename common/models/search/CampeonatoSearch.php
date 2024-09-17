<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Campeonato;

/**
 * CampeonatoSearch represents the model behind the search form about `common\models\Campeonato`.
 */
class CampeonatoSearch extends Campeonato
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'anio', 'id_nucleo_arbitros'], 'integer'],
            [['code', 'nombre', 'detalle'], 'safe'],
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
        $query = Campeonato::find();

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
            'anio' => $this->anio,
            'id_nucleo_arbitros' => $this->id_nucleo_arbitros,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'detalle', $this->detalle]);

        return $dataProvider;
    }
}
