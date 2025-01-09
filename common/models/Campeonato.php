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
 * @property Directivos[] $directivos
 * @property Documentos[] $documentos
 * @property Equipo[] $equipos
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
        // return [
        //     [['code', 'nombre', 'anio', 'id_nucleo_arbitros', 'estado'], 'required'],
        //     [['id_nucleo_arbitros'], 'default', 'value' => null],
        //     [['id_nucleo_arbitros'], 'integer'],
        //     [['estado'], 'boolean'],
        //     [['code'], 'string', 'max' => 20],
        //     [['nombre'], 'string', 'max' => 250],
        //     [['anio'], 'string', 'max' => 50],
        //     [['detalle'], 'string', 'max' => 1000],
        //     [['id_nucleo_arbitros'], 'exist', 'skipOnError' => true, 'targetClass' => NucleArbitros::class, 'targetAttribute' => ['id_nucleo_arbitros' => 'id']],
        // ];
        return [
            // Reglas de validación
            [['nombre', 'anio'], 'required', 'message' => '{attribute} no puede estar vacío.'], // Campos obligatorios
            [['id_nucleo_arbitros'], 'required', 'message' => 'Es obligatorio.'], // Campos obligatorios
            [['id_nucleo_arbitros'], 'default', 'value' => null], // Valor predeterminado para id_nucleo_arbitros
            [['id_nucleo_arbitros'], 'integer'], // Validación de tipo entero
            [['estado'], 'boolean'], // Validación de tipo booleano
            [['code'], 'string', 'max' => 20], // Validación de longitud máxima para 'code'
            [['nombre'], 'string', 'max' => 250], // Validación de longitud máxima para 'nombre'
            [['anio'], 'string', 'max' => 50], // Validación de longitud máxima para 'anio'
            [['detalle'], 'string', 'max' => 1000], // Validación de longitud máxima para 'detalle'
            [
                ['id_nucleo_arbitros'], 
                'exist', 
                'skipOnError' => true, 
                'targetClass' => NucleArbitros::class, 
                'targetAttribute' => ['id_nucleo_arbitros' => 'id'] // Verifica la existencia en la tabla relacionada
            ],
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
     * Gets query for [[Directivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivos()
    {
        return $this->hasMany(Directivos::class, ['id_campeonato' => 'id']);
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
     * Gets query for [[Equipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::class, ['id_campeonato' => 'id']);
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
