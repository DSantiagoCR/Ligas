<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "documentos".
 *
 * @property int $id
 * @property int $id_campeonato
 * @property int $id_tipo_documento
 * @property string|null $link
 * @property string|null $nombre
 * @property string|null $descripcion
 *
 * @property Campeonato $campeonato
 * @property Catalogos $tipoDocumento
 */
class Documentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_campeonato', 'id_tipo_documento'], 'required'],
            [['id_campeonato', 'id_tipo_documento'], 'default', 'value' => null],
            [['id_campeonato', 'id_tipo_documento'], 'integer'],
            [['link'], 'string', 'max' => 255],
            [['nombre'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 1000],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_tipo_documento'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_tipo_documento' => 'id']],
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
            'id_tipo_documento' => 'Id Tipo Documento',
            'link' => 'Link',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
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
     * Gets query for [[TipoDocumento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDocumento()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_tipo_documento']);
    }
}
