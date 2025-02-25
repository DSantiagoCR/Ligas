<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_equipo".
 *
 * @property int $id
 * @property int $id_equipo
 * @property int $id_user
 * @property int $estado
 * @property int $id_campeonato
 *
 * @property Campeonato $campeonato
 * @property Equipo $equipo
 * @property User $user
 */
class UserEquipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_equipo', 'id_user', 'estado', 'id_campeonato'], 'required'],
            [['id_equipo', 'id_user', 'estado', 'id_campeonato'], 'default', 'value' => null],
            [['id_equipo', 'id_user', 'estado', 'id_campeonato'], 'integer'],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_equipo' => 'Equipo',
            'id_user' => 'User',
            'estado' => 'Estado',
            'id_campeonato' => 'Campeonato',
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
     * Gets query for [[Equipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipo::class, ['id' => 'id_equipo']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
