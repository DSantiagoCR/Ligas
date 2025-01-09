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
 * @property string|null $link_foto
 * @property int|null $id_equipo
 * @property bool|null $puede_jugar
 * @property int|null $ta_acumulada
 * @property int|null $ta_actuales
 * @property int|null $tr_acumulada
 * @property int|null $tr_actuales
 * @property int|null $goles
 * @property string|null $link_ficha
 *
 * @property DetalleVocalia[] $detalleVocalias
 * @property Equipo $equipo
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
            [['id_estado_civil', 'hijos', 'id_equipo', 'ta_acumulada', 'ta_actuales', 'tr_acumulada', 'tr_actuales', 'goles'], 'default', 'value' => null],
            [['id_estado_civil', 'hijos', 'id_equipo', 'ta_acumulada', 'ta_actuales', 'tr_acumulada', 'tr_actuales', 'goles'], 'integer'],
            [['estado', 'puede_jugar'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['nombres', 'apellidos'], 'string', 'max' => 100],
            [['cedula', 'celular'], 'string', 'max' => 50],
            [['link_foto', 'link_ficha'], 'string', 'max' => 1000],
            [['id_estado_civil'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_estado_civil' => 'id']],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo' => 'id']],
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
            'link_foto' => 'Link Foto',
            'id_equipo' => 'Id Equipo',
            'puede_jugar' => 'Puede Jugar',
            'ta_acumulada' => 'Ta Acumulada',
            'ta_actuales' => 'Ta Actuales',
            'tr_acumulada' => 'Tr Acumulada',
            'tr_actuales' => 'Tr Actuales',
            'goles' => 'Goles',
            'link_ficha' => 'Link Ficha',
        ];
    }

    /**
     * Gets query for [[DetalleVocalias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleVocalias()
    {
        return $this->hasMany(DetalleVocalia::class, ['id_jugador' => 'id']);
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
     * Gets query for [[EstadoCivil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCivil()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_estado_civil']);
    }
}
