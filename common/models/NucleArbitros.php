<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nucle_arbitros".
 *
 * @property int $id
 * @property string $code
 * @property string $nombre
 * @property bool $estado
 *
 * @property Arbitros[] $arbitros
 * @property Campeonato[] $campeonatos
 */
class NucleArbitros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nucle_arbitros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'nombre', 'estado'], 'required'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 20],
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
     * Gets query for [[Arbitros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArbitros()
    {
        return $this->hasMany(Arbitros::class, ['id_nucleo_arbitro' => 'id']);
    }

    /**
     * Gets query for [[Campeonatos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCampeonatos()
    {
        return $this->hasMany(Campeonato::class, ['id_nucleo_arbitros' => 'id']);
    }
}
