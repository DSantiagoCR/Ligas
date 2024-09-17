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
 *
 * @property DetalleFecha[] $detalleFechas
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
            [['code', 'nombre', 'estado'], 'required'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 255],
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
        ];
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
