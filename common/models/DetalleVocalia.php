<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "detalle_vocalia".
 *
 * @property int $id
 * @property int $id_cabecera_vocalia
 * @property int $id_equipo_jugador_categoria
 * @property int|null $ta
 * @property int|null $tr
 * @property int|null $goles
 * @property bool|null $entrega_carnet
 *
 * @property CabeceraVocalia $cabeceraVocalia
 * @property EquipoCategoriaJugador $equipoJugadorCategoria
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
            [['id_cabecera_vocalia', 'id_equipo_jugador_categoria'], 'required'],
            [['id_cabecera_vocalia', 'id_equipo_jugador_categoria', 'ta', 'tr', 'goles'], 'default', 'value' => null],
            [['id_cabecera_vocalia', 'id_equipo_jugador_categoria', 'ta', 'tr', 'goles'], 'integer'],
            [['entrega_carnet'], 'boolean'],
            [['id_cabecera_vocalia'], 'exist', 'skipOnError' => true, 'targetClass' => CabeceraVocalia::class, 'targetAttribute' => ['id_cabecera_vocalia' => 'id']],
            [['id_equipo_jugador_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => EquipoCategoriaJugador::class, 'targetAttribute' => ['id_equipo_jugador_categoria' => 'id']],
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
            'id_equipo_jugador_categoria' => 'Id Equipo Jugador Categoria',
            'ta' => 'Ta',
            'tr' => 'Tr',
            'goles' => 'Goles',
            'entrega_carnet' => 'Entrega Carnet',
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
     * Gets query for [[EquipoJugadorCategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoJugadorCategoria()
    {
        return $this->hasOne(EquipoCategoriaJugador::class, ['id' => 'id_equipo_jugador_categoria']);
    }
}
