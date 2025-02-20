<?php

namespace common\models\search;

use common\models\CabeceraFechas;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CabeceraVocalia;
use common\models\DetalleFecha;
use yii\helpers\ArrayHelper;

/**
 * CabeceraVocaliaSearch represents the model behind the search form about `common\models\CabeceraVocalia`.
 */
class CabeceraVocaliaSearch extends CabeceraVocalia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_campeonato', 'ta_e1', 'ta_e2', 'tr_e1', 'tr_e2', 'id_arbitro', 'id_estado_vocalia', 'hora_empieza', 'id_equipo_1', 'id_equipo_2', 'id_equipo_vocal', 'id_equipo_veedor', 'id_cab_fecha'], 'integer'],
            [['informe_vocal', 'informe_veedor', 'informe_arbitro', 'novedades_equipo_1', 'novedades_equipo_2', 'novedades_generales', 'novedades_directiva', 'link_documento', 'hora_termina'], 'safe'],
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
    public function search($params, $dia = null)
    {
        // $modelCabFechas = CabeceraFechas::find()
        //     ->where(['dia' => $dia])
        //     ->andWhere(['estado' => true])
        //     ->andWhere(['in', 'id_estado_fecha', [45, 46]])
        //     ->all();
        // $arrayCabFechas = ArrayHelper::map($modelCabFechas, 'id', 'id');

        // $modelDetFecha = DetalleFecha::find()
        //     ->where(['in', 'id_cabecera_fecha', $arrayCabFechas])
        //     ->all();
        // $arrayDetFecha = ArrayHelper::map($modelDetFecha, 'id', 'id');


        // $query = CabeceraVocalia::find()
        //     ->where(['id_det_fecha' => $arrayDetFecha]);



        $query = CabeceraVocalia::find()
            ->where([
                'id_det_fecha' => DetalleFecha::find()
                    ->select('id')
                    ->where([
                        'id_cabecera_fecha' => CabeceraFechas::find()
                            ->select('id')
                            ->where([
                                'dia' => $dia,
                                'estado' => true
                            ])
                            ->andWhere(['in', 'id_estado_fecha', [45, 46]])
                    ])
            ]);

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
            'ta_e1' => $this->ta_e1,
            'ta_e2' => $this->ta_e2,
            'tr_e1' => $this->tr_e1,
            'tr_e2' => $this->tr_e2,
            'id_arbitro' => $this->id_arbitro,
            'id_estado_vocalia' => $this->id_estado_vocalia,
            'hora_empieza' => $this->hora_empieza,
            'id_equipo_1' => $this->id_equipo_1,
            'id_equipo_2' => $this->id_equipo_2,
            'id_equipo_vocal' => $this->id_equipo_vocal,
            'id_equipo_veedor' => $this->id_equipo_veedor,
            'id_cab_fecha' => $this->id_cab_fecha,
        ]);

        $query->andFilterWhere(['like', 'informe_vocal', $this->informe_vocal])
            ->andFilterWhere(['like', 'informe_veedor', $this->informe_veedor])
            ->andFilterWhere(['like', 'informe_arbitro', $this->informe_arbitro])
            ->andFilterWhere(['like', 'novedades_equipo_1', $this->novedades_equipo_1])
            ->andFilterWhere(['like', 'novedades_equipo_2', $this->novedades_equipo_2])
            ->andFilterWhere(['like', 'novedades_generales', $this->novedades_generales])
            ->andFilterWhere(['like', 'novedades_directiva', $this->novedades_directiva])
            ->andFilterWhere(['like', 'link_documento', $this->link_documento])
            ->andFilterWhere(['like', 'hora_termina', $this->hora_termina]);

        return $dataProvider;
    }
}
