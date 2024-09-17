<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "directivos".
 *
 * @property int $id
 * @property string $code
 * @property string $nombre
 * @property string $apellido
 * @property string $fecha_nacimiento
 * @property string $cedula
 * @property int $id_estado_civil
 * @property bool $estado
 *
 * @property DirectivaEquipos[] $directivaEquipos
 * @property DirectivaLiga[] $directivaLigas
 * @property Catalogos $estadoCivil
 */
class Directivos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'directivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'nombre', 'apellido', 'fecha_nacimiento', 'cedula', 'id_estado_civil', 'estado'], 'required'],
            [['fecha_nacimiento'], 'safe'],
            [['id_estado_civil'], 'default', 'value' => null],
            [['id_estado_civil'], 'integer'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['cedula'], 'string', 'max' => 50],
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
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'cedula' => 'Cedula',
            'id_estado_civil' => 'Id Estado Civil',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[DirectivaEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivaEquipos()
    {
        return $this->hasMany(DirectivaEquipos::class, ['id_directivo' => 'id']);
    }

    /**
     * Gets query for [[DirectivaLigas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivaLigas()
    {
        return $this->hasMany(DirectivaLiga::class, ['id_directivo' => 'id']);
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
    public function nombreApellido()
    {
        return ($this->nombre. " " .$this->apellido);
    }
}
