<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "arbitros".
 *
 * @property int $id
 * @property string $code
 * @property int $id_nucleo_arbitro
 * @property string $nombre
 * @property string $apellido
 * @property float $calificacion_promedio
 * @property string|null $fecha_nacimiento
 * @property string|null $cedula
 * @property int|null $hijos
 * @property bool $estado
 *
 * @property CabeceraVocalia[] $cabeceraVocalias
 * @property NucleArbitros $nucleoArbitro
 */
class Arbitros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arbitros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'id_nucleo_arbitro', 'nombre', 'apellido', 'calificacion_promedio', 'estado'], 'required'],
            [['id_nucleo_arbitro', 'hijos'], 'default', 'value' => null],
            [['id_nucleo_arbitro', 'hijos'], 'integer'],
            [['calificacion_promedio'], 'number'],
            [['fecha_nacimiento'], 'safe'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['cedula'], 'string', 'max' => 50],
            [['id_nucleo_arbitro'], 'exist', 'skipOnError' => true, 'targetClass' => NucleArbitros::class, 'targetAttribute' => ['id_nucleo_arbitro' => 'id']],
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
            'id_nucleo_arbitro' => 'Id Nucleo Arbitro',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'calificacion_promedio' => 'Calificacion Promedio',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'cedula' => 'Cedula',
            'hijos' => 'Hijos',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[CabeceraVocalias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_arbitro' => 'id']);
    }

    /**
     * Gets query for [[NucleoArbitro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNucleoArbitro()
    {
        return $this->hasOne(NucleArbitros::class, ['id' => 'id_nucleo_arbitro']);
    }
}
