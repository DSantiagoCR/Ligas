<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Arbitros;

/**
 * ArbitrosSearch represents the model behind the search form about `common\models\Arbitros`.
 */
class ArbitrosSearch extends Arbitros
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nucleo_arbitro', 'hijos'], 'integer'],
            [['code', 'nombre', 'apellido', 'fecha_nacimiento', 'cedula'], 'safe'],
            [['calificacion_promedio'], 'number'],
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
        $query = Arbitros::find();

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
            'id_nucleo_arbitro' => $this->id_nucleo_arbitro,
            'calificacion_promedio' => $this->calificacion_promedio,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'hijos' => $this->hijos,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'cedula', $this->cedula]);

        return $dataProvider;
    }
}
