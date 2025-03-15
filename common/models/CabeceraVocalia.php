<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cabecera_vocalia".
 *
 * @property int $id
 * @property int $id_campeonato
 * @property int|null $ta_e1
 * @property int|null $ta_e2
 * @property int|null $tr_e1
 * @property int|null $tr_e2
 * @property string|null $informe_vocal
 * @property string|null $informe_veedor
 * @property int|null $id_arbitro
 * @property string|null $informe_arbitro
 * @property string|null $novedades_equipo_1
 * @property string|null $novedades_equipo_2
 * @property string|null $novedades_generales
 * @property string|null $novedades_directiva
 * @property int $id_estado_vocalia
 * @property string|null $link_documento
 * @property int|null $hora_empieza
 * @property string|null $hora_termina
 * @property int $id_equipo_1
 * @property int $id_equipo_2
 * @property int|null $id_equipo_vocal
 * @property int|null $id_equipo_veedor
 * @property int $id_cab_fecha
 * @property int|null $id_det_fecha 
 * @property string|null $hora_inicia
 * @property string|null $hora_fin
 * @property Arbitros $arbitro
 * @property CabeceraFechas $cabFecha
 * @property Campeonato $campeonato
 * @property DetalleFecha $detFecha
 * @property DetalleVocalia[] $detalleVocalias
 * @property Equipo $equipo1
 * @property Equipo $equipo2
 * @property Equipo $equipoVeedor
 * @property Equipo $equipoVocal
 * @property Catalogos $estadoVocalia
 */
class CabeceraVocalia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabecera_vocalia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_campeonato', 'id_estado_vocalia', 'id_equipo_1', 'id_equipo_2', 'id_cab_fecha'], 'required'],
            [['id_campeonato', 'ta_e1', 'ta_e2', 'tr_e1', 'tr_e2', 'id_arbitro', 'id_estado_vocalia', 'hora_empieza', 'id_equipo_1', 'id_equipo_2', 'id_equipo_vocal', 'id_equipo_veedor', 'id_cab_fecha', 'id_det_fecha'], 'default', 'value' => null],
            [['id_campeonato', 'ta_e1', 'ta_e2', 'tr_e1', 'tr_e2', 'id_arbitro', 'id_estado_vocalia', 'hora_empieza', 'id_equipo_1', 'id_equipo_2', 'id_equipo_vocal', 'id_equipo_veedor', 'id_cab_fecha', 'id_det_fecha'], 'integer'],
            [['informe_vocal', 'informe_veedor', 'informe_arbitro', 'novedades_equipo_1', 'novedades_equipo_2', 'novedades_generales', 'novedades_directiva'], 'string', 'max' => 2500],
            [['link_documento'], 'string', 'max' => 255],
            [['hora_termina'], 'string', 'max' => 20],
            [['hora_inicia', 'hora_fin'], 'safe'],
            [['id_arbitro'], 'exist', 'skipOnError' => true, 'targetClass' => Arbitros::class, 'targetAttribute' => ['id_arbitro' => 'id']],
            [['id_cab_fecha'], 'exist', 'skipOnError' => true, 'targetClass' => CabeceraFechas::class, 'targetAttribute' => ['id_cab_fecha' => 'id']],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_estado_vocalia'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_estado_vocalia' => 'id']],
            [['id_equipo_1'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo_1' => 'id']],
            [['id_equipo_2'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo_2' => 'id']],
            [['id_equipo_vocal'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo_vocal' => 'id']],
            [['id_equipo_veedor'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo_veedor' => 'id']],
            [['id_det_fecha'], 'exist', 'skipOnError' => true, 'targetClass' => DetalleFecha::class, 'targetAttribute' => ['id_det_fecha' => 'id']],
            [['id_det_fecha'], 'exist', 'skipOnError' => true, 'targetClass' => DetalleFecha::class, 'targetAttribute' => ['id_det_fecha' => 'id']],
             
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_campeonato' => 'Campeonato',
            'ta_e1' => 'Ta E1',
            'ta_e2' => 'Ta E2',
            'tr_e1' => 'Tr E1',
            'tr_e2' => 'Tr E2',
            'informe_vocal' => 'Informe Vocal',
            'informe_veedor' => 'Informe Veedor',
            'id_arbitro' => 'Arbitro',
            'informe_arbitro' => 'Informe Arbitro',
            'novedades_equipo_1' => 'Novedades Equipo 1',
            'novedades_equipo_2' => 'Novedades Equipo 2',
            'novedades_generales' => 'Novedades Generales',
            'novedades_directiva' => 'Novedades Directiva',
            'id_estado_vocalia' => 'Estado Vocalia',
            'link_documento' => 'Link Documento',
            'hora_empieza' => 'Hora Empieza',
            'hora_termina' => 'Hora Termina',
            'id_equipo_1' => 'Equipo 1',
            'id_equipo_2' => 'Equipo 2',
            'id_equipo_vocal' => 'Equipo Vocal',
            'id_equipo_veedor' => 'Equipo Veedor',
            'id_cab_fecha' => 'Cab Fecha',
            'id_det_fecha' => 'Det Fecha',
            'hora_inicia' => 'Hora Inicia',
            'hora_fin' => 'Hora Fin',
        ];
    }
    /**
     * Gets query for [[DetFecha]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */
    public function getDetFecha()
    {
        return $this->hasOne(DetalleFecha::class, ['id' => 'id_det_fecha']);
    }
    /**
     * Gets query for [[Arbitro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArbitro()
    {
        return $this->hasOne(Arbitros::class, ['id' => 'id_arbitro']);
    }

    /**
     * Gets query for [[CabFecha]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabFecha()
    {
        return $this->hasOne(CabeceraFechas::class, ['id' => 'id_cab_fecha']);
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
     * Gets query for [[DetalleVocalias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleVocalias()
    {
        return $this->hasMany(DetalleVocalia::class, ['id_cabecera_vocalia' => 'id']);
    }

    /**
     * Gets query for [[Equipo1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo1()
    {
        return $this->hasOne(Equipo::class, ['id' => 'id_equipo_1']);
    }

    /**
     * Gets query for [[Equipo2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo2()
    {
        return $this->hasOne(Equipo::class, ['id' => 'id_equipo_2']);
    }

    /**
     * Gets query for [[EquipoVeedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoVeedor()
    {
        return $this->hasOne(Equipo::class, ['id' => 'id_equipo_veedor']);
    }

    /**
     * Gets query for [[EquipoVocal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoVocal()
    {
        return $this->hasOne(Equipo::class, ['id' => 'id_equipo_vocal']);
    }

    /**
     * Gets query for [[EstadoVocalia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoVocalia()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_estado_vocalia']);
    }
}
