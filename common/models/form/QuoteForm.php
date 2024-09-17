<?php

namespace common\models\form;

use common\models\Ship;
use common\models\Itinerary;
use common\models\Years;
use Yii;
use yii\base\Model;
use frontend\controllers\ApiRestController;

/**
 * ContactForm is the model behind the contact form.
 */
class QuoteForm extends Model
{
    public $token;
    public $step;

    public $adt;
    public $chd;
    public $date;
    public $duration;
    public $ship_id;

    public $date_ini;
    public $date_fin;
    public $pax;
    public $itinerary;

//
//    /** ARMADO DE CABINAS **/
    public $cabins;
    public $cabin_pax = 0;
    public $cabin_total = 0;
//    public $cabin_item = 0;

//    public $promotion;
//    public $normal_date;
//    public $only_cruises;
//    public $go_package;
    public $ship_name;
//    public $acommodation_id;
//    public $token;

//    /*** PARAMETROS PROFORMA ****/
    public $out_id;
    public $cgg = 1;
    public $tax = 1;
    public $tkt = 1;
    public $reference;
    public $promo_availability;
    public $promo_cabin;
    public $observation;
// PARAMETROS CONTACTO PAX
    public $title_id;
    public $name;
    public $last_name;
    public $document_number;
    public $country_id;
    public $city_id;
    public $birthdate;
    public $language_id;
    public $hotel_contact;
    public $emergency_phone;
    public $phone;
    public $email;
    public $appellative;

    public $document_type;
    public $city_name;
    public $country_name;
    public $names;
    public $street;
    public $cod_prf;
//    public $fee_logist = 1;
    public $description;
    public $nationality = 1;
    public $lead_id;
    public $agente_id;
//
//    /*** FORMATO PROFORMA ***/
    public $sailing_date;
    public $sailing_end_date;
//    public $itinerary;
    public $duration_text;
//
//    /**** RESULT ***/
    public $quote_id;
    public $name_cabins;
    public $total_cruce;
    public $cgg_val;
    public $tax_val;
    public $tkt_val;
    public $tkt_fee_val;
    public $extra_service;
    public $cgg_det;
    public $tax_det;
    public $tkt_det;
    public $tkt_fee_det;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adt', 'chd', 'duration', 'date'], 'required', 'on' => 'step-form'],
            [['name', 'phone', 'email', 'appellative'], 'required', 'on' => 'step-summary'],
            [['adt', 'chd', 'duration', 'pax', 'cabin_pax', 'out_id', 'cgg', 'tax', 'tkt', 'promo_availability', 'promo_cabin','total_cruce','cgg_val','tax_val','tkt_val','tkt_fee_val','lead_id','agente_id'], 'integer'],
            [['ship_id', 'itinerary', 'name', 'phone', 'reference', 'observation','name_cabins','appellative'], 'string'],
            [['date', 'date_ini', 'date_fin', 'sailing_end_date', 'sailing_date', 'cabins','cabin_total','extra_service','cgg_det','tax_det','tkt_det','tkt_fee_det'], 'safe'],
            [['email'], 'email'],
            ['token', 'tokenValidate'],
            ['date', 'rangeDates'],
            ['adt', 'totalPaxs'],
            [['language_id', 'last_name', 'email', 'country_id'], 'required', 'on' => 'hold'],
            [['title_id', 'document_number', 'country_id', 'city_id', 'quote_id', 'nationality'], 'integer'],
            [['token',  'ship_name', 'name', 'last_name', 'hotel_contact',
                'emergency_phone', 'phone', 'duration_text', 'document_type', 'street','country_name', 'city_name', 'names','cod_prf','description','appellative'], 'string'],
//            [['promotion', 'normal_date', 'only_cruises', 'go_package', 'step', 'out_id',
//                'acommodation_id', 'cabin_total', 'cabin_item', 'language_id', 'fee_logist', 'lead_id', 'agente_id'], 'integer'],

//            [['date', 'date_ini', 'date_fin', 'cabins', 'birthdate'], 'safe'],
            ['email', 'email'],
//            ['street', 'streetValidate'],
//            ['name', 'nameValidate']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'adt' => 'Adults',
            'chd' => 'Children',
            'date' => 'Days',
            'duration' => 'Duration',
            'promotion' => 'Promo',
            'normal_date' => 'Normal date',
            'only_cruises' => 'Only cruise',
            'go_package' => 'GoPack',
            'pax' => 'Passengers',
        ];
    }

    public function tokenValidate()
    {
        if(!$this->token){
            $this->token = ApiRestController::loginApi();
        }
    }

    public function rangeDates()
    {
        $this->date_ini = date("Y-m-d", strtotime($this->date));
        $this->date_fin = date("Y-m-d", strtotime($this->date . "+ 30 days"));
    }

    public function getShip()
    {
        $ship = Ship::findOne(['status' => 1, 'code' => $this->ship_id]);
        return $ship;
    }

    public function getItinerary()
    {
        $anio = Years::findOne(['name' => date('Y', strtotime($this->date)), 'status' => 1]);
        $itinerary = Itinerary::findOne(['status' => 1, 'ship_id' => $this->getShip()->id, 'code' => $this->itinerary, 'year_id' => $anio->id]);
        return $itinerary;
    }

    public function totalPaxs()
    {
        $this->pax = ($this->cabin_pax) ? $this->cabin_pax : ($this->adt + $this->chd);
        if($this->pax < 1){
            $this->addError('adt', 'The minimum number of passengers is 1.');
            $this->addError('date', 'The minimum number of passengers is 1.');
        }
        if($this->chd >0 and $this->adt <=0 ){
            $this->addError('adt', 'The minimum number of Adults is 1.');
        }
//        $this->reference = "API_" . strtoupper(ltrim(rtrim($this->name))) . "X" . $this->pax;
    }
//
//    public function streetValidate()
//    {
//        $this->street = $this->country_name.', '.$this->city_name;
//    }
//
//    public function nameValidate()
//    {
//        $this->names = ($this->last_name) ? $this->name.' '.$this->last_name : $this->name;
//    }

}
