<?php

namespace common\models\search;

use common\models\Campeonato;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GrupoEquipo;

/**
 * GrupoEquipoSearch represents the model behind the search form about `\common\models\GrupoEquipo`.
 */
class GrupoEquipoSearch extends GrupoEquipo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_campeonato', 'id_grupo', 'id_equipo'], 'integer'],
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
        $query = GrupoEquipo::find();

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
            'id_grupo' => $this->id_grupo,
            'id_equipo' => $this->id_equipo,
        ]);

        return $dataProvider;
    }
    public function searchGrupoEquipo($params,$id_grupo=null)
    {
        $modelCampeonato = Campeonato::find()->where(['estado' => true])->one();

        $query = GrupoEquipo::find()
        ->where(['id_grupo'=>$id_grupo])
        ->andWhere(['id_campeonato'=>$modelCampeonato->id]);

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
            'id_grupo' => $this->id_grupo,
            'id_equipo' => $this->id_equipo,
        ]);

        $query->andFilterWhere(['like', 'id_campeonato', $this->id_campeonato])
            ->andFilterWhere(['like', 'id_grupo', $this->id_grupo])
            ->andFilterWhere(['like', 'id_equipo', $this->id_equipo]);


        return $dataProvider;
    }
}
