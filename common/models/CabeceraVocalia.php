<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cabecera_vocalia".
 *
 * @property int $id
 * @property int $id_campeonato
 * @property int $id_fechas
 * @property int $id_equipo_categoria1
 * @property int $id_equipo_categoria2
 * @property int $ta_e1
 * @property int $ta_e2
 * @property int $tr_e1
 * @property int $tr_e2
 * @property int $id_equipo_categoria_vocal
 * @property string|null $informe_vocal
 * @property int $id_equipo_categoria_veedor
 * @property string|null $informe_veedor
 * @property int $id_arbitro
 * @property string|null $informe_arbitro
 * @property string|null $novedades_equipo_1
 * @property string|null $novedades_equipo_2
 * @property string|null $novedades_generales
 * @property string|null $novedades_directiva
 * @property int $id_estado_vocalia
 * @property string|null $link_documento
 * @property int|null $hora_empieza
 * @property string|null $hora_termina
 *
 * @property Arbitros $arbitro
 * @property Campeonato $campeonato
 * @property DetalleVocalia[] $detalleVocalias
 * @property EquipoCategoria $equipoCategoria1
 * @property EquipoCategoria $equipoCategoria2
 * @property EquipoCategoria $equipoCategoriaVocal
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
            [['id_campeonato', 'id_fechas', 'id_equipo_categoria1', 'id_equipo_categoria2', 'ta_e1', 'ta_e2', 'tr_e1', 'tr_e2', 'id_equipo_categoria_vocal', 'id_equipo_categoria_veedor', 'id_arbitro', 'id_estado_vocalia'], 'required'],
            [['id_campeonato', 'id_fechas', 'id_equipo_categoria1', 'id_equipo_categoria2', 'ta_e1', 'ta_e2', 'tr_e1', 'tr_e2', 'id_equipo_categoria_vocal', 'id_equipo_categoria_veedor', 'id_arbitro', 'id_estado_vocalia', 'hora_empieza'], 'default', 'value' => null],
            [['id_campeonato', 'id_fechas', 'id_equipo_categoria1', 'id_equipo_categoria2', 'ta_e1', 'ta_e2', 'tr_e1', 'tr_e2', 'id_equipo_categoria_vocal', 'id_equipo_categoria_veedor', 'id_arbitro', 'id_estado_vocalia', 'hora_empieza'], 'integer'],
            [['informe_vocal', 'informe_veedor', 'informe_arbitro', 'novedades_equipo_1', 'novedades_equipo_2', 'novedades_generales', 'novedades_directiva'], 'string', 'max' => 2500],
            [['link_documento'], 'string', 'max' => 255],
            [['hora_termina'], 'string', 'max' => 20],
            [['id_arbitro'], 'exist', 'skipOnError' => true, 'targetClass' => Arbitros::class, 'targetAttribute' => ['id_arbitro' => 'id']],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_estado_vocalia'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_estado_vocalia' => 'id']],
            [['id_equipo_categoria1'], 'exist', 'skipOnError' => true, 'targetClass' => EquipoCategoria::class, 'targetAttribute' => ['id_equipo_categoria1' => 'id']],
            [['id_equipo_categoria2'], 'exist', 'skipOnError' => true, 'targetClass' => EquipoCategoria::class, 'targetAttribute' => ['id_equipo_categoria2' => 'id']],
            [['id_equipo_categoria_vocal'], 'exist', 'skipOnError' => true, 'targetClass' => EquipoCategoria::class, 'targetAttribute' => ['id_equipo_categoria_vocal' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_campeonato' => 'Id Campeonato',
            'id_fechas' => 'Id Fechas',
            'id_equipo_categoria1' => 'Id Equipo Categoria1',
            'id_equipo_categoria2' => 'Id Equipo Categoria2',
            'ta_e1' => 'Ta E1',
            'ta_e2' => 'Ta E2',
            'tr_e1' => 'Tr E1',
            'tr_e2' => 'Tr E2',
            'id_equipo_categoria_vocal' => 'Id Equipo Categoria Vocal',
            'informe_vocal' => 'Informe Vocal',
            'id_equipo_categoria_veedor' => 'Id Equipo Categoria Veedor',
            'informe_veedor' => 'Informe Veedor',
            'id_arbitro' => 'Id Arbitro',
            'informe_arbitro' => 'Informe Arbitro',
            'novedades_equipo_1' => 'Novedades Equipo 1',
            'novedades_equipo_2' => 'Novedades Equipo 2',
            'novedades_generales' => 'Novedades Generales',
            'novedades_directiva' => 'Novedades Directiva',
            'id_estado_vocalia' => 'Id Estado Vocalia',
            'link_documento' => 'Link Documento',
            'hora_empieza' => 'Hora Empieza',
            'hora_termina' => 'Hora Termina',
        ];
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
     * Gets query for [[EquipoCategoria1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategoria1()
    {
        return $this->hasOne(EquipoCategoria::class, ['id' => 'id_equipo_categoria1']);
    }

    /**
     * Gets query for [[EquipoCategoria2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategoria2()
    {
        return $this->hasOne(EquipoCategoria::class, ['id' => 'id_equipo_categoria2']);
    }

    /**
     * Gets query for [[EquipoCategoriaVocal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCategoriaVocal()
    {
        return $this->hasOne(EquipoCategoria::class, ['id' => 'id_equipo_categoria_vocal']);
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
