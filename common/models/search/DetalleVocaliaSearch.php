<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DetalleVocalia;

/**
 * DetalleVocaliaSearch represents the model behind the search form about `common\models\DetalleVocalia`.
 */
class DetalleVocaliaSearch extends DetalleVocalia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_cabecera_vocalia', 'ta', 'tr', 'goles', 'id_jugador'], 'integer'],
            [['entrega_carnet'], 'boolean'],
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
        $query = DetalleVocalia::find();

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
            'id_cabecera_vocalia' => $this->id_cabecera_vocalia,
            'ta' => $this->ta,
            'tr' => $this->tr,
            'goles' => $this->goles,
            'entrega_carnet' => $this->entrega_carnet,
            'id_jugador' => $this->id_jugador,
        ]);

        return $dataProvider;
    }
}
