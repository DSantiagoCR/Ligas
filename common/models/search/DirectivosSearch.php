<?php

namespace common\models\search;

use common\models\Campeonato;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Directivos;

/**
 * DirectivosSearch represents the model behind the search form about `common\models\Directivos`.
 */
class DirectivosSearch extends Directivos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_estado_civil','id_equipo', 'id_tipo_directivo', 'id_campeonato'], 'integer'],
            [['code', 'nombre', 'apellido', 'fecha_nacimiento', 'cedula'], 'safe'],
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
        
        $query = Directivos::find()->where(['id_campeonato'=>$modelsCampeonato->id]);
        if ($idUserEquipo) {
            $query = Directivos::find()
                ->where(['id_equipo' => $idUserEquipo,'id_campeonato'=>$modelsCampeonato->id]);
        }

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
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'id_estado_civil' => $this->id_estado_civil,
            'estado' => $this->estado,
            'id_equipo' => $this->id_equipo,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'upper(nombre)', strtoupper( $this->nombre??'')])
            ->andFilterWhere(['like', 'upper(apellido)', strtoupper($this->apellido??'')])
            ->andFilterWhere(['like', 'cedula', $this->cedula]);
           
        return $dataProvider;
    }
}
