<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipo".
 *
 * @property int $id
 * @property string|null $code
 * @property string $nombre
 * @property string|null $fecha_fundacion
 * @property string|null $link_logotipo
 * @property bool $activo
 * @property int|null $id_genero
 * @property int|null $id_categoria
 * @property int|null $id_campeonato
 *
 * @property CabeceraVocalia[] $cabeceraVocalias
 * @property CabeceraVocalia[] $cabeceraVocalias0
 * @property CabeceraVocalia[] $cabeceraVocalias1
 * @property CabeceraVocalia[] $cabeceraVocalias2
 * @property Campeonato $campeonato
 * @property Catalogos $categoria
 * @property Directivos[] $directivos
 * @property Catalogos $genero
 * @property GrupoEquipo[] $grupoEquipos
 * @property Jugador[] $jugadors
 */
class Equipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'activo','fecha_fundacion','id_genero','id_categoria'], 'required'],
            [['fecha_fundacion'], 'safe'],
            [['activo'], 'boolean'],
            [['id_genero', 'id_categoria', 'id_campeonato'], 'default', 'value' => null],
            [['id_genero', 'id_categoria', 'id_campeonato'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 255],
            [['link_logotipo'], 'string', 'max' => 1000],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_genero'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_genero' => 'id']],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_categoria' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'nombre' => 'Nombre',
            'fecha_fundacion' => 'Fecha Fundacion',
            'link_logotipo' => 'Link Logotipo',
            'activo' => 'Activo',
            'id_genero' => 'Genero',
            'id_categoria' => 'Categoria',
            'id_campeonato' => 'Campeonato',
        ];
    }

    /**
     * Gets query for [[CabeceraVocalias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_equipo_1' => 'id']);
    }

    /**
     * Gets query for [[CabeceraVocalias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias0()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_equipo_2' => 'id']);
    }

    /**
     * Gets query for [[CabeceraVocalias1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias1()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_equipo_vocal' => 'id']);
    }

    /**
     * Gets query for [[CabeceraVocalias2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias2()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_equipo_veedor' => 'id']);
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
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_categoria']);
    }

    /**
     * Gets query for [[Directivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivos()
    {
        return $this->hasMany(Directivos::class, ['id_equipo' => 'id']);
    }

    /**
     * Gets query for [[Genero]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_genero']);
    }

    /**
     * Gets query for [[GrupoEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEquipos()
    {
        return $this->hasMany(GrupoEquipo::class, ['id_equipo' => 'id']);
    }

    /**
     * Gets query for [[Jugadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJugadors()
    {
        return $this->hasMany(Jugador::class, ['id_equipo' => 'id']);
    }
}
