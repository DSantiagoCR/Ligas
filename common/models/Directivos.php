<?php

namespace common\models;

use common\models\Util\HelperGeneral;
use Yii;

/**
 * This is the model class for table "directivos".
 *
 * @property int $id
 * @property string $code
 * @property string $nombre
 * @property string $apellido
 * @property string $fecha_nacimiento
 * @property string $cedula
 * @property int $id_estado_civil
 * @property bool $estado
 * @property int|null $id_equipo
 * @property int|null $id_tipo_directivo
 * @property int|null $id_campeonato
 *
 * @property Campeonato $campeonato
 * @property DirectivaLiga[] $directivaLigas
 * @property Equipo $equipo
 * @property Catalogos $estadoCivil
 * @property Catalogos $tipoDirectivo
 */
class Directivos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public static function tableName()
    {
        return 'directivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'fecha_nacimiento', 'cedula', 'id_estado_civil', 'estado','id_equipo','id_tipo_directivo', 'id_campeonato'], 'required'],
            [['fecha_nacimiento'], 'safe'],
            [['id_estado_civil', 'id_equipo', 'id_tipo_directivo', 'id_campeonato'], 'default', 'value' => null],
            [['id_estado_civil', 'id_equipo', 'id_tipo_directivo', 'id_campeonato'], 'integer'],
            [['estado'], 'boolean'],
            [['code'], 'string', 'max' => 20],
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['cedula'], 'string', 'max' => 50],
            [['id_campeonato'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::class, 'targetAttribute' => ['id_campeonato' => 'id']],
            [['id_estado_civil'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_estado_civil' => 'id']],
            [['id_tipo_directivo'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogos::class, 'targetAttribute' => ['id_tipo_directivo' => 'id']],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::class, 'targetAttribute' => ['id_equipo' => 'id']],
            ['cedula', 'validarCedula'],
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
            'apellido' => 'Apellido',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'cedula' => 'Cedula',
            'id_estado_civil' => 'Id Estado Civil',
            'estado' => 'Estado',
            'id_equipo' => 'Id Equipo',
            'id_tipo_directivo' => 'Id Tipo Directivo',
            'id_campeonato' => 'Id Campeonato',
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
     * Gets query for [[DirectivaLigas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivaLigas()
    {
        return $this->hasMany(DirectivaLiga::class, ['id_directivo' => 'id']);
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
     * Gets query for [[EstadoCivil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCivil()
    {
        return $this->hasOne(Catalogos::class, ['id' => 'id_estado_civil']);
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
    public function nombreApellido()
    {
        return ($this->nombre. " " .$this->apellido);
    }

    public  function validarCedula($attribute)
    {
        $modelCampeonatoActual = HelperGeneral::devuelveCampeonatoActual();

        $modelJugadorBuscado = Directivos::find()
            ->where(['cedula' => $this->cedula])
            ->all();

        if ($this->id) {
            $modelJugadorBuscado = Directivos::find()
                ->where(['cedula' => $this->cedula])
                ->andWhere(['not in','id',[$this->id]])
                ->all();

                
        }

        if ($modelJugadorBuscado) {
            $equiposCampeonato = Equipo::find()
                ->where(['id_campeonato' => $modelCampeonatoActual->id])
                ->andWhere(['activo' => true])
                //->andWhere(['<>', 'id', $this->id_equipo])
                ->all();

            foreach ($modelJugadorBuscado as $jugador) {
                foreach ($equiposCampeonato as $equipo) {
                    if ($jugador->id_equipo == $equipo->id) {
                        $this->addError($attribute, 'La cédula que quiere ingresar ya esta registrada.');
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
