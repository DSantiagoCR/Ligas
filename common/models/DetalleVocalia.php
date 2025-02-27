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
 * @property int|null $id_jugador_cambio
 * @property int|null $num_jugador_cambio
 * @property string|null $nom_jugador
 * @property string|null $num_jugador
 *
 * @property CabeceraVocalia $cabeceraVocalia
 * @property Equipo $equipo
 * @property Jugador $jugador
 * @property Jugador $jugadorCambio
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
            [['id_cabecera_vocalia', 'ta', 'tr', 'goles', 'id_jugador', 'id_equipo', 'id_jugador_cambio', 'num_jugador_cambio'], 'default', 'value' => null],
            [['id_cabecera_vocalia', 'ta', 'tr', 'goles', 'id_jugador', 'id_equipo', 'id_jugador_cambio', 'num_jugador_cambio'], 'integer'],
            [['entrega_carnet', 'puede_jugar', 'estado'], 'boolean'],
            [['nom_jugador'], 'string', 'max' => 255],
            [['num_jugador'], 'string', 'max' => 10],
            [['id_cabecera_vocalia'], 'exist', 'skipOnError' => true, 'targetClass' => CabeceraVocalia::class, 'targetAttribute' => ['id_cabecera_vocalia' => 'id']],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_jugador'], 'exist', 'skipOnError' => true, 'targetClass' => Jugador::class, 'targetAttribute' => ['id_jugador' => 'id']],
            [['id_jugador_cambio'], 'exist', 'skipOnError' => true, 'targetClass' => Jugador::class, 'targetAttribute' => ['id_jugador_cambio' => 'id']],
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
            'id_jugador_cambio' => 'Id Jugador Cambio',
            'num_jugador_cambio' => 'Num Jugador Cambio',
            'nom_jugador' => 'Nom Jugador',
            'num_jugador' => 'Num Jugador',
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

    /**
     * Gets query for [[JugadorCambio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJugadorCambio()
    {
        return $this->hasOne(Jugador::class, ['id' => 'id_jugador_cambio']);
    }
}
