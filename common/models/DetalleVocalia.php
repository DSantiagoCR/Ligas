<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "detalle_vocalia".
 *
 * @property int $id
 * @property int $id_cabecera_vocalia
 * @property int|null $ta
 * @property int|null $tr
 * @property int|null $goles
 * @property bool|null $entrega_carnet
 * @property int $id_jugador
 * @property int $id_equipo
 * @property bool|null $puede_jugar
 * @property bool|null $estado
 *
 * @property CabeceraVocalia $cabeceraVocalia
 * @property Equipo $equipo
 * @property Jugador $jugador
 */
class DetalleVocalia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalle_vocalia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cabecera_vocalia', 'id_jugador', 'id_equipo'], 'required'],
            [['id_cabecera_vocalia', 'ta', 'tr', 'goles', 'id_jugador', 'id_equipo'], 'default', 'value' => null],
            [['id_cabecera_vocalia', 'ta', 'tr', 'goles', 'id_jugador', 'id_equipo'], 'integer'],
            [['entrega_carnet', 'puede_jugar', 'estado'], 'boolean'],
            [['id_cabecera_vocalia'], 'exist', 'skipOnError' => true, 'targetClass' => CabeceraVocalia::class, 'targetAttribute' => ['id_cabecera_vocalia' => 'id']],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_jugador'], 'exist', 'skipOnError' => true, 'targetClass' => Jugador::class, 'targetAttribute' => ['id_jugador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cabecera_vocalia' => 'Id Cabecera Vocalia',
            'ta' => 'Ta',
            'tr' => 'Tr',
            'goles' => 'Goles',
            'entrega_carnet' => 'Entrega Carnet',
            'id_jugador' => 'Id Jugador',
            'id_equipo' => 'Id Equipo',
            'puede_jugar' => 'Puede Jugar',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[CabeceraVocalia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalia()
    {
        return $this->hasOne(CabeceraVocalia::class, ['id' => 'id_cabecera_vocalia']);
    }

    /**
     * Gets query for [[Equipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipo::class, ['id' => 'id_equipo']);
    }

    /**
     * Gets query for [[Jugador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJugador()
    {
        return $this->hasOne(Jugador::class, ['id' => 'id_jugador']);
    }
}
