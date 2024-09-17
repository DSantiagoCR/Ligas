<?php

namespace common\models\form;

use Yii;
use yii\base\Model;
use frontend\controllers\ApiRestController;

/**
 * ContactForm is the model behind the contact form.
 */
class PriceCabin extends Model
{
    public $token;
    public $id;
    public $ship_id;
    public $rate_type = 1;
    public $nationality_id = 1;
    public $duration;
    public $cabin_id;
    public $accommodation_id;
    public $acomodation_text;
    public $cabin_name;
    public $available;
    public $code;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duration', 'id', 'rate_type', 'nationality_id', 'duration', 'cabin_id', 'accommodation_id','available'], 'integer'],
            [['ship_id','cabin_name','acomodation_text','code'], 'string'],
            [['token'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'rate_type' => 'Rate Type',
            'nationality_id' => 'Nationality Id',
            'cabin_id' => 'Cabin Id',
            'accommodation_id' => 'Accommodation Id',
            'ship_id' => 'Ship Id',
            'token' => 'Token',
            'cabin_name' => 'Cabin Name',
        ];
    }
}
