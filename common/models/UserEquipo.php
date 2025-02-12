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
 *
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
            [['id', 'id_equipo', 'id_user', 'estado'], 'required'],
            [['id', 'id_equipo', 'id_user', 'estado'], 'default', 'value' => null],
            [['id', 'id_equipo', 'id_user', 'estado'], 'integer'],
            [['id'], 'unique'],
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
            'id_equipo' => 'Id Equipo',
            'id_user' => 'Id User',
            'estado' => 'Estado',
        ];
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
