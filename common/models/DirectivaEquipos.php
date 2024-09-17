<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "directiva_equipos".
 *
 * @property int $id
 * @property string $code
 * @property int $id_equipo
 * @property int $id_directivo
 * @property int $id_tipo_directivo
 * @property int $id_campeonato
 * @property bool $activo
 *
 * @property Campeonato $campeonato
 * @property Directivos $directivo
 * @property Equipo $equipo
 * @property Catalogos $tipoDirectivo
 */
class DirectivaEquipos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'directiva_equipos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'id_equipo', 'id_directivo', 'id_tipo_directivo', 'id_campeonato', 'activo'], 'required'],
            [['id_equipo', 'id_directivo', 'id_tipo_directivo', 'id_campeonato'], 'default', 'value' => null],
            [['id_equipo', 'id_directivo', 'id_tipo_directivo', 'id_campeonato'], 'integer'],
            [['activo'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_tipo_directivo'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_tipo_directivo' => 'id']],
            [['id_directivo'], 'exist', 'skipOnError' => true, 'targetClass' => Directivos::class, 'targetAttribute' => ['id_directivo' => 'id']],
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
            'id_equipo' => 'Id Equipo',
            'id_directivo' => 'Id Directivo',
            'id_tipo_directivo' => 'Id Tipo Directivo',
            'id_campeonato' => 'Id Campeonato',
            'activo' => 'Activo',
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
     * Gets query for [[Directivo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivo()
    {
        return $this->hasOne(Directivos::class, ['id' => 'id_directivo']);
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
     * Gets query for [[TipoDirectivo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDirectivo()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_tipo_directivo']);
    }    
}
