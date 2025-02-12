<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserEquipo;

/**
 * UserEquipoSearch represents the model behind the search form about `\common\models\UserEquipo`.
 */
class UserEquipoSearch extends UserEquipo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_equipo', 'id_user', 'estado'], 'integer'],
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
        $query = UserEquipo::find();

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
            'id_equipo' => $this->id_equipo,
            'id_user' => $this->id_user,
            'estado' => $this->estado,
        ]);

        return $dataProvider;
    }
}
