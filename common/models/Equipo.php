<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipo".
 *
 * @property int $id
 * @property string $code
 * @property string $nombre
 * @property string|null $fecha_fundacion
 * @property string|null $link_logotipo
 * @property bool $activo
 * @property int $id_genero
 *
 * @property DirectivaEquipos[] $directivaEquipos
 * @property EquipoCategoria[] $equipoCategorias
 * @property Catalogos $genero
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
            [['code', 'nombre', 'activo', 'id_genero'], 'required'],
            [['fecha_fundacion'], 'safe'],
            [['activo'], 'boolean'],
            [['id_genero'], 'default', 'value' => null],
            [['id_genero'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['nombre', 'link_logotipo'], 'string', 'max' => 255],
            [['id_genero'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_genero' => 'id']],
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
            'id_genero' => 'Id Genero',
        ];
    }

    /**
     * Gets query for [[DirectivaEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivaEquipos()
    {
        return $this->hasMany(DirectivaEquipos::class, ['id_equipo' => 'id']);
    }

    /**
     * Gets query for [[EquipoCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategorias()
    {
        return $this->hasMany(EquipoCategoria::class, ['id_equipo' => 'id']);
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
