<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parametros".
 *
 * @property int $id
 * @property string $code
 * @property string|null $nombre
 * @property string|null $valor1
 * @property string|null $valor2
 * @property string|null $valor3
 * @property string|null $valor4
 */
class Parametros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parametros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 255],
            [['valor1', 'valor2', 'valor3', 'valor4'], 'string', 'max' => 4000],
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
            'valor1' => 'Valor1',
            'valor2' => 'Valor2',
            'valor3' => 'Valor3',
            'valor4' => 'Valor4',
        ];
    }
}
