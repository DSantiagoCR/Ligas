<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jugador".
 *
 * @property int $id
 * @property string|null $code
 * @property string $nombres
 * @property string $apellidos
 * @property string|null $fecha_nacimiento
 * @property string|null $cedula
 * @property string|null $celular
 * @property int|null $id_estado_civil
 * @property int|null $hijos
 * @property bool $estado
 *
 * @property EquipoCategoriaJugador[] $equipoCategoriaJugadors
 * @property Catalogos $estadoCivil
 */
class Jugador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jugador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'estado'], 'required'],
            [['fecha_nacimiento'], 'safe'],
            [['id_estado_civil', 'hijos'], 'default', 'value' => null],
            [['id_estado_civil', 'hijos'], 'integer'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['nombres', 'apellidos'], 'string', 'max' => 100],
            [['cedula', 'celular'], 'string', 'max' => 50],
            [['id_estado_civil'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_estado_civil' => 'id']],
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
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'cedula' => 'Cedula',
            'celular' => 'Celular',
            'id_estado_civil' => 'Id Estado Civil',
            'hijos' => 'Hijos',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[EquipoCategoriaJugadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategoriaJugadors()
    {
        return $this->hasMany(EquipoCategoriaJugador::class, ['id_jugador' => 'id']);
    }

    /**
     * Gets query for [[EstadoCivil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCivil()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_estado_civil']);
    }
}
