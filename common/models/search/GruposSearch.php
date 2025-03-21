<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Grupos;
use common\models\Util\HelperGeneral;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * GruposSearch represents the model behind the search form about `common\models\Grupos`.
 */
class GruposSearch extends Grupos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','id_catalogo','id_genero','id_categoria'], 'integer'],
            [['code', 'nombre'], 'safe'],
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
        $modelCampeonato = HelperGeneral::devuelveCampeonatoActual();

        $query = Grupos::find()->where(['id_campeonato'=>$modelCampeonato->id]);

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
            'id_catalogo' => $this->id_catalogo,
            'id_genero' => $this->id_genero,
            'id_categoria' => $this->id_categoria,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

        $query->orderBy(['id_catalogo'=>SORT_ASC,'nombre'=>SORT_ASC]);

        return $dataProvider;
    }
}
