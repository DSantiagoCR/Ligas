<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "detalle_fecha".
 *
 * @property int $id
 * @property int $id_cabecera_fecha
 * @property int $id_grupo
 * @property int $id_grupo_equipo1
 * @property int $id_grupo_equipo2
 * @property int $goles_equipo1
 * @property int $goles_equipo2
 * @property string $hora_inicio
 * @property int $id_estado_partido
 * @property bool $estado
 * @property int|null $id_etapa
 * @property int|null $ganador1 
 * @property int|null $ganador2 
 *
 * @property CabeceraFechas $cabeceraFecha
 * @property Catalogos $estadoPartido
 * @property Catalogos $etapa
 * @property Grupos $grupo
 * @property GrupoEquipo $grupoEquipo1
 * @property GrupoEquipo $grupoEquipo2
 */
class DetalleFecha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalle_fecha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cabecera_fecha', 'id_grupo', 'id_grupo_equipo1', 'id_grupo_equipo2', 'goles_equipo1', 'goles_equipo2', 'hora_inicio', 'id_estado_partido', 'estado', 'id_etapa'], 'required'],
            [['id_cabecera_fecha', 'id_grupo', 'id_grupo_equipo1', 'id_grupo_equipo2', 'goles_equipo1', 'goles_equipo2', 'id_estado_partido','ganador1','ganador2'], 'default', 'value' => null],
            [['id_cabecera_fecha', 'id_grupo', 'id_grupo_equipo1', 'id_grupo_equipo2', 'goles_equipo1', 'goles_equipo2', 'id_estado_partido', 'id_etapa'], 'integer'],
            [['estado'], 'boolean'],
            [['hora_inicio'], 'string', 'max' => 20],
            [['id_cabecera_fecha'], 'exist', 'skipOnError' => true, 'targetClass' => CabeceraFechas::class, 'targetAttribute' => ['id_cabecera_fecha' => 'id']],
            [['id_estado_partido'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_estado_partido' => 'id']],
            [['id_grupo_equipo1'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoEquipo::class, 'targetAttribute' => ['id_grupo_equipo1' => 'id']],
            [['id_grupo_equipo2'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoEquipo::class, 'targetAttribute' => ['id_grupo_equipo2' => 'id']],
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
            'id_cabecera_fecha' => 'Id Cabecera Fecha',
            'id_grupo' => 'Id Grupo',
            'id_grupo_equipo1' => 'Grupo Equipo1',
            'id_grupo_equipo2' => 'Grupo Equipo2',
            'goles_equipo1' => 'Goles Equipo1',
            'goles_equipo2' => 'Goles Equipo2',
            'hora_inicio' => 'Hora Inicio',
            'id_estado_partido' => 'Estado Partido',
            'estado' => 'Estado',
            'id_etapa' => 'Etapa',
            'ganador1' => 'Ganador1',
            'ganador2' => 'Ganador2',

        ];
    }

    /** 
     * Gets query for [[Etapa]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */
    public function getEtapa()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_etapa']);
    }

    /**
     * Gets query for [[CabeceraFecha]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabeceraFecha()
    {
        return $this->hasOne(CabeceraFechas::class, ['id' => 'id_cabecera_fecha']);
    }

    /**
     * Gets query for [[EstadoPartido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPartido()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_estado_partido']);
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

    /**
     * Gets query for [[GrupoEquipo1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEquipo1()
    {
        return $this->hasOne(GrupoEquipo::class, ['id' => 'id_grupo_equipo1']);
    }

    /**
     * Gets query for [[GrupoEquipo2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEquipo2()
    {
        return $this->hasOne(GrupoEquipo::class, ['id' => 'id_grupo_equipo2']);
    }
    /**
     * Gets query for [[HoraInicio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHoraInicio()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'hora_inicio']);
    }
}
