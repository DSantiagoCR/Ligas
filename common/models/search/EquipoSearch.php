<?php

namespace common\models\search;

use common\models\Campeonato;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Equipo;
use DateTime;

/**
 * EquipoSearch represents the model behind the search form about `common\models\Equipo`.
 */
class EquipoSearch extends Equipo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_genero','id_categoria'], 'integer'],
            [['code', 'nombre', 'fecha_fundacion', 'link_logotipo'], 'safe'],
            [['activo'], 'boolean'],
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

        $query = Equipo::find()->where(['activo'=>true,'id_campeonato'=>$modelsCampeonato->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50, // Número de registros por página
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!$this->validarFecha($this->fecha_fundacion??null))
        {
            $this->fecha_fundacion = null;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_fundacion' => $this->fecha_fundacion,
            'activo' => $this->activo,
            'id_genero' => $this->id_genero,
            'id_categoria' => $this->id_categoria,
            'id_campeonato' => $this->id_campeonato,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'upper(nombre)', strtoupper($this->nombre??'')])
            ->andFilterWhere(['like', 'link_logotipo', $this->link_logotipo]);

        return $dataProvider;
    }
    private function validarFecha($fecha, $formato = 'Y-m-d') {

        if($fecha==null)
        {
            return false;
        }
       
        $d = DateTime::createFromFormat($formato, $fecha);
        return $d && $d->format($formato) === $fecha;
    }
}
