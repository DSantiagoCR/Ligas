<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cabecera_fechas".
 *
 * @property int $id
 * @property string $dia
 * @property string $fecha
 * @property int $id_campeonato
 * @property int $id_estado_fecha
 * @property bool $estado
 *
 * @property Campeonato $campeonato
 * @property DetalleFecha[] $detalleFechas
 * @property Catalogos $estadoFecha
 */
class CabeceraFechas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabecera_fechas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dia', 'fecha', 'id_campeonato', 'id_estado_fecha', 'estado'], 'required'],
            [['fecha'], 'safe'],
            [['id_campeonato', 'id_estado_fecha'], 'default', 'value' => null],
            [['id_campeonato', 'id_estado_fecha'], 'integer'],
            [['estado'], 'boolean'],
            [['dia'], 'string', 'max' => 50],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_estado_fecha'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_estado_fecha' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dia' => 'Dia',
            'fecha' => 'Fecha',
            'id_campeonato' => 'Id Campeonato',
            'id_estado_fecha' => 'Id Estado Fecha',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Campeonato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCampeonato()
    {
        return $this->hasOne(Campeonato::class, ['id' => 'id_campeonato']);
    }

    /**
     * Gets query for [[DetalleFechas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleFechas()
    {
        return $this->hasMany(DetalleFecha::class, ['id_cabecera_fecha' => 'id']);
    }

    /**
     * Gets query for [[EstadoFecha]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoFecha()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_estado_fecha']);
    }
}
