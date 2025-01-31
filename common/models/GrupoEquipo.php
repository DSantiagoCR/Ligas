<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grupo_equipo".
 *
 * @property int $id
 * @property int $id_campeonato
 * @property int $id_grupo
 * @property int $id_equipo
 *
 * @property Campeonato $campeonato
 * @property DetalleFecha[] $detalleFechas
 * @property DetalleFecha[] $detalleFechas0
 * @property Equipo $equipo
 * @property Grupos $grupo
 */
class GrupoEquipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grupo_equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_campeonato', 'id_grupo', 'id_equipo'], 'required'],
            [['id_campeonato', 'id_grupo', 'id_equipo'], 'default', 'value' => null],
            [['id_campeonato', 'id_grupo', 'id_equipo'], 'integer'],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_grupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupos::class, 'targetAttribute' => ['id_grupo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_campeonato' => 'Campeonato',
            'id_grupo' => 'Grupo',
            'id_equipo' => 'Equipo',
        ];
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
     * Gets query for [[DetalleFechas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleFechas()
    {
        return $this->hasMany(DetalleFecha::class, ['id_grupo_equipo1' => 'id']);
    }

    /**
     * Gets query for [[DetalleFechas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleFechas0()
    {
        return $this->hasMany(DetalleFecha::class, ['id_grupo_equipo2' => 'id']);
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
     * Gets query for [[Grupo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(Grupos::class, ['id' => 'id_grupo']);
    }
}
