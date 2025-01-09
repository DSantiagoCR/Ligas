<?php 

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipo_categoria".
 *
 * @property int $id
 * @property int $id_equipo
 * @property int $id_categoria
 * @property int $id_genero
 * @property bool $estado
 *
 * @property CabeceraVocalia[] $cabeceraVocalias
 * @property CabeceraVocalia[] $cabeceraVocalias0
 * @property CabeceraVocalia[] $cabeceraVocalias1
 * @property Catalogos $categoria
 * @property Equipo $equipo
 * @property EquipoCategoriaJugador[] $equipoCategoriaJugadors
 * @property Catalogos $genero
 */
class EquipoCategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipo_categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_equipo', 'id_categoria', 'id_genero', 'estado'], 'required'],
            [['id_equipo', 'id_categoria', 'id_genero'], 'default', 'value' => null],
            [['id_equipo', 'id_categoria', 'id_genero'], 'integer'],
            [['estado'], 'boolean'],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_categoria' => 'id']],
            [['id_genero'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_genero' => 'id']],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_equipo' => 'Id Equipo',
            'id_categoria' => 'Id Categoria',
            'id_genero' => 'Id Genero',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[CabeceraVocalias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_equipo_categoria1' => 'id']);
    }

    /**
     * Gets query for [[CabeceraVocalias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias0()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_equipo_categoria2' => 'id']);
    }

    /**
     * Gets query for [[CabeceraVocalias1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias1()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_equipo_categoria_vocal' => 'id']);
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
     * Gets query for [[Equipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipo::class, ['id' => 'id_equipo']);
    }

    /**
     * Gets query for [[EquipoCategoriaJugadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategoriaJugadors()
    {
        return $this->hasMany(EquipoCategoriaJugador::class, ['id_equipo_categoria' => 'id']);
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
}
