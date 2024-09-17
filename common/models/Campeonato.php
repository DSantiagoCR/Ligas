<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "campeonato".
 *
 * @property int $id
 * @property string $code
 * @property string $nombre
 * @property string $anio
 * @property int $id_nucleo_arbitros
 * @property bool $estado
 * @property string|null $detalle
 *
 * @property CabeceraFechas[] $cabeceraFechas
 * @property CabeceraVocalia[] $cabeceraVocalias
 * @property DirectivaEquipos[] $directivaEquipos
 * @property Documentos[] $documentos
 * @property GrupoEquipo[] $grupoEquipos
 * @property NucleArbitros $nucleoArbitros
 */
class Campeonato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campeonato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'nombre', 'anio', 'id_nucleo_arbitros', 'estado'], 'required'],
            [['id_nucleo_arbitros'], 'default', 'value' => null],
            [['id_nucleo_arbitros'], 'integer'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 250],
            [['anio'], 'string', 'max' => 50],
            [['detalle'], 'string', 'max' => 1000],
            [['id_nucleo_arbitros'], 'exist', 'skipOnError' => true, 'targetClass' => NucleArbitros::class, 'targetAttribute' => ['id_nucleo_arbitros' => 'id']],
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
            'anio' => 'Anio',
            'id_nucleo_arbitros' => 'Id Nucleo Arbitros',
            'estado' => 'Estado',
            'detalle' => 'Detalle',
        ];
    }

    /**
     * Gets query for [[CabeceraFechas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraFechas()
    {
        return $this->hasMany(CabeceraFechas::class, ['id_campeonato' => 'id']);
    }

    /**
     * Gets query for [[CabeceraVocalias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraVocalias()
    {
        return $this->hasMany(CabeceraVocalia::class, ['id_campeonato' => 'id']);
    }

    /**
     * Gets query for [[DirectivaEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivaEquipos()
    {
        return $this->hasMany(DirectivaEquipos::class, ['id_campeonato' => 'id']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documentos::class, ['id_campeonato' => 'id']);
    }

    /**
     * Gets query for [[GrupoEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEquipos()
    {
        return $this->hasMany(GrupoEquipo::class, ['id_campeonato' => 'id']);
    }

    /**
     * Gets query for [[NucleoArbitros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNucleoArbitros()
    {
        return $this->hasOne(NucleArbitros::class, ['id' => 'id_nucleo_arbitros']);
    }
}
