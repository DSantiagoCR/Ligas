<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalogos".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $valor
 * @property string|null $descripcion
 * @property bool $estado
 * @property int|null $id_catalogo
 *
 * @property CabeceraFechas[] $cabeceraFechas
 * @property CabeceraVocalia[] $cabeceraVocalias
 * @property Catalogos $catalogo
 * @property Catalogos[] $catalogos
 * @property DetalleFecha[] $detalleFechas
 * @property DirectivaEquipos[] $directivaEquipos
 * @property DirectivaLiga[] $directivaLigas
 * @property Directivos[] $directivos
 * @property Documentos[] $documentos
 * @property EquipoCategoria[] $equipoCategorias
 * @property EquipoCategoria[] $equipoCategorias0
 */
class Catalogos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'required'],
            [['estado'], 'boolean'],
            [['id_catalogo'], 'default', 'value' => null],
            [['id_catalogo'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['valor'], 'string', 'max' => 500],
            [['descripcion'], 'string', 'max' => 5000],
            [['id_catalogo'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_catalogo' => 'id']],
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
            'valor' => 'Valor',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
            'id_catalogo' => 'Id Catalogo',
        ];
    }

    /**
     * Gets query for [[CabeceraFechas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraFechas()
    {
        return $this->hasMany(CabeceraFechas::class, ['id_estado_fecha' => 'id']);
    }

    /**
     * Gets query for [[CabeceraVocalias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_estado_vocalia' => 'id']);
    }

    /**
     * Gets query for [[Catalogo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogo()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_catalogo']);
    }

    /**
     * Gets query for [[Catalogos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogos()
    {
        return $this->hasMany(Catalogos::class, ['id_catalogo' => 'id']);
    }
  

    /**
     * Gets query for [[DetalleFechas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleFechas()
    {
        return $this->hasMany(DetalleFecha::class, ['id_estado_partido' => 'id']);
    }

    /**
     * Gets query for [[DirectivaEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivaEquipos()
    {
        return $this->hasMany(DirectivaEquipos::class, ['id_tipo_directivo' => 'id']);
    }

    /**
     * Gets query for [[DirectivaLigas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivaLigas()
    {
        return $this->hasMany(DirectivaLiga::class, ['id_tipo_directivo' => 'id']);
    }

    /**
     * Gets query for [[Directivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivos()
    {
        return $this->hasMany(Directivos::class, ['id_estado_civil' => 'id']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documentos::class, ['id_tipo_documento' => 'id']);
    }

    /**
     * Gets query for [[EquipoCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategorias()
    {
        return $this->hasMany(EquipoCategoria::class, ['id_categoria' => 'id']);
    }

    /**
     * Gets query for [[EquipoCategorias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategorias0()
    {
        return $this->hasMany(EquipoCategoria::class, ['id_genero' => 'id']);
    }
}
