<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipo_categoria_jugador".
 *
 * @property int $id
 * @property int $id_equipo_categoria
 * @property int $id_jugador
 * @property int $id_campeonato
 * @property bool $puede_jugar
 * @property int $ta_acumulada
 * @property int $tr_acumulada
 * @property int $ta_actuales
 * @property int $tr_actuales
 * @property int $goles
 * @property string|null $link_ficha
 *
 * @property DetalleVocalia[] $detalleVocalias
 * @property EquipoCategoria $equipoCategoria
 * @property GrupoEquipo[] $grupoEquipos
 * @property Jugador $jugador
 */
class EquipoCategoriaJugador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipo_categoria_jugador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_equipo_categoria', 'id_jugador', 'id_campeonato', 'puede_jugar', 'ta_acumulada', 'tr_acumulada', 'ta_actuales', 'tr_actuales', 'goles'], 'required'],
            [['id_equipo_categoria', 'id_jugador', 'id_campeonato', 'ta_acumulada', 'tr_acumulada', 'ta_actuales', 'tr_actuales', 'goles'], 'default', 'value' => null],
            [['id_equipo_categoria', 'id_jugador', 'id_campeonato', 'ta_acumulada', 'tr_acumulada', 'ta_actuales', 'tr_actuales', 'goles'], 'integer'],
            [['puede_jugar'], 'boolean'],
            [['link_ficha'], 'string', 'max' => 255],
            [['id_equipo_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => EquipoCategoria::class, 'targetAttribute' => ['id_equipo_categoria' => 'id']],
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
            'id_equipo_categoria' => 'Id Equipo Categoria',
            'id_jugador' => 'Id Jugador',
            'id_campeonato' => 'Id Campeonato',
            'puede_jugar' => 'Puede Jugar',
            'ta_acumulada' => 'Ta Acumulada',
            'tr_acumulada' => 'Tr Acumulada',
            'ta_actuales' => 'Ta Actuales',
            'tr_actuales' => 'Tr Actuales',
            'goles' => 'Goles',
            'link_ficha' => 'Link Ficha',
        ];
    }

    /**
     * Gets query for [[DetalleVocalias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleVocalias()
    {
        return $this->hasMany(DetalleVocalia::class, ['id_equipo_jugador_categoria' => 'id']);
    }

    /**
     * Gets query for [[EquipoCategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategoria()
    {
        return $this->hasOne(EquipoCategoria::class, ['id' => 'id_equipo_categoria']);
    }

    /**
     * Gets query for [[GrupoEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEquipos()
    {
        return $this->hasMany(GrupoEquipo::class, ['id_equipo_categoria_jugador' => 'id']);
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
