<?php

namespace common\models\search;

use common\models\Campeonato;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Documentos;

/**
 * DocumentosSearch represents the model behind the search form about `common\models\Documentos`.
 */
class DocumentosSearch extends Documentos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_campeonato', 'id_tipo_documento'], 'integer'],
            [['link', 'nombre', 'descripcion'], 'safe'],
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
        $modelsCampeonato = Campeonato::find()->where(['estado' => true])->one();
        $query = Documentos::find()->where(['id_campeonato'=>$modelsCampeonato->id]);;

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
            'id_campeonato' => $this->id_campeonato,
            'id_tipo_documento' => $this->id_tipo_documento,
        ]);

        $query->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
