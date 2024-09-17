<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "liga_barrial".
 *
 * @property int $id
 * @property string $code
 * @property string $nombre
 * @property string|null $fecha_fundacion
 * @property bool $estado
 *
 * @property DirectivaLiga[] $directivaLigas
 */
class LigaBarrial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'liga_barrial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'nombre', 'estado'], 'required'],
            [['fecha_fundacion'], 'safe'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 200],
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
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[DirectivaLigas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivaLigas()
    {
        return $this->hasMany(DirectivaLiga::class, ['id_liga_barrial' => 'id']);
    }
}
