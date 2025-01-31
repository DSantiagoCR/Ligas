<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grupos".
 *
 * @property int $id
 * @property string $code
 * @property string $nombre
 * @property bool $estado
 * @property int|null $id_catalogo
 * @property int|null $id_genero 
 * @property int|null $id_categoria
 *
 * @property Catalogos $catalogo
 * @property Catalogos $categoria
 * @property DetalleFecha[] $detalleFechas
 * @property Catalogos $genero
 * @property GrupoEquipo[] $grupoEquipos
 */
class Grupos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grupos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'nombre', 'estado', 'id_catalogo', 'id_genero', 'id_categoria'], 'required'],
            [['estado'], 'boolean'],
            [['id_catalogo', 'id_genero', 'id_categoria'], 'default', 'value' => null],
            [['id_catalogo', 'id_genero', 'id_categoria'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 255],
            [['id_catalogo'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'message' => 'Por favor seleccione Etapa', 'targetAttribute' => ['id_catalogo' => 'id']],
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
            'estado' => 'Estado',
            'id_catalogo' => 'Catalogo',
            'id_genero' => 'Genero',
            'id_categoria' => 'Categoria',
        ];
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
     * Gets query for [[Genero]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */
    public function getGenero()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_genero']);
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
     * Gets query for [[DetalleFechas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleFechas()
    {
        return $this->hasMany(DetalleFecha::class, ['id_grupo' => 'id']);
    }

    /**
     * Gets query for [[GrupoEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEquipos()
    {
        return $this->hasMany(GrupoEquipo::class, ['id_grupo' => 'id']);
    }
}
