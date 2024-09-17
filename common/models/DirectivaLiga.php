<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "directiva_liga".
 *
 * @property int $id
 * @property string $code
 * @property int $id_liga_barrial
 * @property int $id_directivo
 * @property int $id_tipo_directivo
 * @property int $id_campeonato
 * @property bool $estado
 *
 * @property Directivos $directivo
 * @property LigaBarrial $ligaBarrial
 * @property Catalogos $tipoDirectivo
 */
class DirectivaLiga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'directiva_liga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'id_liga_barrial', 'id_directivo', 'id_tipo_directivo', 'id_campeonato', 'estado'], 'required'],
            [['id_liga_barrial', 'id_directivo', 'id_tipo_directivo', 'id_campeonato'], 'default', 'value' => null],
            [['id_liga_barrial', 'id_directivo', 'id_tipo_directivo', 'id_campeonato'], 'integer'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['id_tipo_directivo'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_tipo_directivo' => 'id']],
            [['id_directivo'], 'exist', 'skipOnError' => true, 'targetClass' => Directivos::class, 'targetAttribute' => ['id_directivo' => 'id']],
            [['id_liga_barrial'], 'exist', 'skipOnError' => true, 'targetClass' => LigaBarrial::class, 'targetAttribute' => ['id_liga_barrial' => 'id']],
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
            'id_liga_barrial' => 'Id Liga Barrial',
            'id_directivo' => 'Id Directivo',
            'id_tipo_directivo' => 'Id Tipo Directivo',
            'id_campeonato' => 'Id Campeonato',
            'estado' => 'Estado',
        ];
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
     * Gets query for [[LigaBarrial]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLigaBarrial()
    {
        return $this->hasOne(LigaBarrial::class, ['id' => 'id_liga_barrial']);
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
