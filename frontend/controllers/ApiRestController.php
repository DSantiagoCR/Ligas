<?php

namespace frontend\controllers;

use common\models\Configuration;
use common\models\form\PriceCabin;
use common\models\form\QuoteForm;
use GuzzleHttp\Client;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use function GuzzleHttp\json_decode;

class ApiRestController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public static function recuperarModelo()
    {
        $model = Configuration::find()->where(['app' => 'book'])->one();
        if (!$model) {
            echo "<h1 style='text-align: center'>Aun no se ha configurado los accesos al cotizador</h1>";
            //die();
        }
        return $model;
    }

    public static function loginApi()
    {
        $config = self::recuperarModelo();
        $url = $config->url . '/' . $config->version;

        $body = ['username' => $config->username, 'password' => $config->password];

        $client = ($config->ssl) ? new Client(['verify' => false, 'http_errors' => false]) : new Client(['http_errors' => false]);
        $res = $client->request('POST', $url . '/login', [
            'body' => json_encode($body),
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);

        if ($res->getStatusCode() == '200') {
            $data = json_decode($res->getBody());
            return $data->access_token;
        } else {
            echo "<h1 style='text-align: center; color: red'>Error de autenticacion, valide los datos con el proveedor</h1>";
            //die();
        }
    }

    public static function availabilityApi(QuoteForm $model)
    {
        $config = self::recuperarModelo();
        $url = $config->url . '/' . $config->version;

        $headers = [
            'Authorization' => 'Bearer ' . $model->token,
            'Accept' => 'application/json',
        ];
        $body = ['from' => $model->date_ini, 'until' => $model->date_fin, 'paxs' => $model->pax, 'duration' => $model->duration];
        if ($model->ship_id) {
            $body = ['from' => $model->date_ini, 'until' => $model->date_fin, 'paxs' => $model->pax,
                'duration' => $model->duration, 'ship_id' => $model->ship_id];
        }

        $res = [];

        try {
            $client = ($config->ssl) ? new Client(['verify' => false]) : new Client();
            $res = $client->request('GET', $url . '/availabilities', [
                'query' => $body,
                'headers' => $headers
            ]);

        } catch (Exception $e) {
            return [];
        } finally {
            if ($res && $res->getStatusCode() == '200') {
                $data = json_decode($res->getBody());
                return self::groupAvailability($data, $model->itinerary);
            } else {
                return [];
            }
        }

//        $client = ($config->ssl) ? new Client(['verify' => false]) : new Client();
//        $res = $client->request('GET', $url . '/availabilities', [
//            'query' => $body,
//            'headers' => $headers
//        ]);
//        if ($res->getStatusCode() == '200') {
//            $data = json_decode($res->getBody());
//            return self::groupAvailability($data, $model->itinerary);
//        }
//        return '';
    }
    private static function groupAvailability($data, $itinerary = '')
    {
        $availabilityWithFilter=[];
        $result = [];
        foreach ($data as $out) {
            unset($out->extensions);
//            unset($out->cabins);
            unset($out->languages);

//            if (ltrim(rtrim($out->combination_itinerary)) == ltrim(rtrim($itinerary))) {
            if(str_contains(ltrim(rtrim($out->combination_itinerary)), ltrim(rtrim($itinerary)))){
                $result[$out->nights][$out->ship->id][] = $out;
            } else {
                if (empty($itinerary)) {
                    $result[$out->nights][$out->ship->id][] = $out;
                }
            }
//            $result[$out->nights][$out->ship->id][$out->itinerary->name][] = $out;
        }
        return $result;
    }
    public static function cabinListApi(QuoteForm $model)
    {
        $config = self::recuperarModelo();
        $url = $config->url . '/' . $config->version;

        $headers = [
            'Authorization' => 'Bearer ' . $model->token,
            'Accept' => 'application/json',
        ];
        $body = ['duration' => $model->duration];
        $client = ($config->ssl) ? new Client(['verify' => false]) :  new Client();
        $res = $client->request('GET', $url . '/availabilities/' . $model->out_id . '/cabins', [
            'query' => $body,
            'headers' => $headers
        ]);
        if ($res->getStatusCode() == '200') {
            $data = json_decode($res->getBody());
//            return self::cabinGroupList($data);
            return $data;
        }
        return '';
    }
    private static function cabinGroupList($data)
    {
        $cabinsList = [];
        foreach ($data->cabins as $cabin) {
            $cabinsList[$cabin->id] = [
                'cabin_id' => $cabin->id,
                'code' => $cabin->code,
                'name' => $cabin->name,
                'min_gross' => $cabin->min_gross,
                'available' => $cabin->available,
                'promotion' => $cabin->promotion
            ];
            foreach ($cabin->type_acommodations as $type) {
                foreach ($type->acommodations as $acommodation) {
                    $cabinsList[$cabin->id]['list'][$acommodation->id] = [
                        'id' => $acommodation->id,
                        'code' => $acommodation->code,
                        'name' => $acommodation->name,
                        'type' => $type->code,
                        'name_type' => $type->name,
                        'paxs' => $type->paxs,
                    ];
                }

            }
        }
        return $cabinsList;
    }

    public static function priceCabinApi(PriceCabin $model)
    {
        $config = self::recuperarModelo();
        $url = $config->url . '/' . $config->version;

        $headers = [
            'Authorization' => 'Bearer ' . $model->token,
            'Accept' => 'application/json',
        ];
        $body = [
            'id' => $model->id,
            'ship_id' => "$model->ship_id",
            'rate_type' => $model->rate_type,
            'nationality_id' => $model->nationality_id,
            'duration' => $model->duration,
            'cabin_id' => $model->cabin_id,
            'accommodation_id' => $model->accommodation_id,
        ];
        $client = ($config->ssl) ? new Client(['verify' => false]) :  new Client();
        $res = $client->request('GET', $url . '/availabilities/cabin-rate', [
            'query' => $body,
            'headers' => $headers
        ]);
        if ($res->getStatusCode() == '200') {
            $data = json_decode($res->getBody());
            return $data;
        }
        return 0;
    }

//    public static function countryListApi(QuoteForm $model)
//    {
//        $config = self::recuperarModelo();
//        $url = $config->url_api . '/' . $config->version_api;
//
//        $headers = [
//            'Authorization' => 'Bearer ' . $model->token,
//            'Accept' => 'application/json',
//        ];
//        $client = ($config->ssl_api) ? new Client(['verify' => false]) :  new Client();
//        $res = $client->request('GET', $url . '/catalogs/countries', [
//            'headers' => $headers
//        ]);
//        if ($res->getStatusCode() == '200') {
//            $data = json_decode($res->getBody());
//            return ArrayHelper::map($data, 'id', 'name');
//        }
//        return '';
//    }

//    public static function nationalityListApi(QuoteForm $model)
//    {
//        $config = self::recuperarModelo();
//        $url = $config->url_api . '/' . $config->version_api;
//
//        $headers = [
//            'Authorization' => 'Bearer ' . $model->token,
//            'Accept' => 'application/json',
//        ];
//        $client = ($config->ssl_api) ? new Client(['verify' => false]) :  new Client();
//        $res = $client->request('GET', $url . '/catalogs/countries', [
//            'headers' => $headers
//        ]);
//        if ($res->getStatusCode() == '200') {
//            return json_decode($res->getBody());
////            return ArrayHelper::map($data, 'id', 'name', 'nationality_id');
//        }
//        return '';
//    }

//    public static function languageListApi(QuoteForm $model)
//    {
//        $config = self::recuperarModelo();
//        $url = $config->url_api . '/' . $config->version_api;
//
//        $headers = [
//            'Authorization' => 'Bearer ' . $model->token,
//            'Accept' => 'application/json',
//        ];
//        $client = ($config->ssl_api) ? new Client(['verify' => false]) :  new Client();
//        $res = $client->request('GET', $url . '/catalogs/languages', [
//            'headers' => $headers
//        ]);
//        if ($res->getStatusCode() == '200') {
//            $data = json_decode($res->getBody());
//            return ArrayHelper::map($data, 'id', 'name');
//        }
//        return '';
//    }

    public static function titleListApi(QuoteForm $model)
    {
        $config = self::recuperarModelo();
        $url = $config->url . '/' . $config->version;

        $headers = [
            'Authorization' => 'Bearer ' . $model->token,
            'Accept' => 'application/json',
        ];
        $client = ($config->ssl) ? new Client(['verify' => false]) :  new Client();
        $res = $client->request('GET', $url . '/catalogs/appellatives', [
            'headers' => $headers
        ]);
        if ($res->getStatusCode() == '200') {
            $data = json_decode($res->getBody());
            return ArrayHelper::map($data, 'id', 'name');
        }
        return '';
    }

//    public static function cityListApi($country_id, $token_id)
//    {
//        $config = self::recuperarModelo();
//        $url = $config->url_api . '/' . $config->version_api;
//
//        $headers = [
//            'Authorization' => 'Bearer ' . $token_id,
//            'Accept' => 'application/json',
//        ];
//        $body = ['country_id' => $country_id];
//        $client = ($config->ssl_api) ? new Client(['verify' => false]) :  new Client();
//        $res = $client->request('GET', $url . '/catalogs/cities', [
//            'query' => $body,
//            'headers' => $headers
//        ]);
//        if ($res->getStatusCode() == '200') {
//            return json_decode($res->getBody());
//        }
//        return '';
//    }

//    public static function holdApi(QuoteForm $model)
//    {
//        $config = self::recuperarModelo();
//        $url = $config->url_api . '/' . $config->version_api;
//
//        $headers = [
//            'Authorization' => 'Bearer ' . $model->token,
//            'Accept' => 'application/json',
//        ];
//        $body = json_encode(self::armarHold($model, $config->aplicacion));
//
//        $client = ($config->ssl_api) ? new Client(['verify' => false]) :  new Client();
//        $res = $client->request('POST', $url . '/quotations/quote-hold', [
//            'body' => $body,
//            'headers' => $headers + ['Content-Type' => 'application/json']
//        ]);
//        if ($res->getStatusCode() == '200') {
//            return json_decode($res->getBody());
//        }
//
//    }

    public static function quoteApi(QuoteForm $model,$flagQuoteHold)
    {
        $config = self::recuperarModelo();
        $url = $config->url . '/' . $config->version;

        $headers = [
            'Authorization' => 'Bearer ' . $model->token,
            'Accept' => 'application/json',
        ];
        $body = json_encode(self::armarHold($model, $config->app, $flagQuoteHold));

        $client = ($config->ssl) ? new Client(['verify' => false]) :  new Client();
        $res = $client->request('POST', $url . '/quotations', [
            'body' => $body,
            'headers' => $headers + ['Content-Type' => 'application/json']
        ]);
        if ($res->getStatusCode() == '200') {
            return json_decode($res->getBody());
        }
    }

    private static function armarHold(QuoteForm $model, $application, $quote = 0)
    {
        $body = [
            'availability_id' => $model->out_id,
            'duration' => $model->duration,
            'cgg' => $model->cgg,
            'tax' => $model->tax,
            'tkt' => $model->tkt,
            'reference' => ($model->reference)?$model->reference:(''.str_replace(' ', '', $model->name).'x'.($model->adt+$model->chd)),
            'promo_availability' => ($model->promo_availability)?$model->promo_availability:0,
            'promo_cabin' => ($model->promo_cabin)?$model->promo_cabin:0,
            'observation' => ($model->observation)?$model->observation:'',
            'total_paxs' => ($model->adt+$model->chd),
            'application' => $application,
            'flag' => $quote,
//            'pedido_id' => $model->quote_id,
            'cabins'=>self::createCabin($model),
            'extra_services'=>self::createExrtaService($model),
        ];
        return $body;
    }
    private static function createCabin($model)
    {
        $arrayCabins = [];
        $isFirstCabin = true;
        if($model->cabins)
        {
            foreach ($model->cabins as $cabin)
            {
                $cabin = (object)$cabin;
                $arrayCabins[] = [
                    'cabin_id' => $cabin->cabin_id,
                    'accommodation_id' => $cabin->accommodation_id,
                    'shared' => 0,
                    'type_shared' => '',
                    'paxs' => ($isFirstCabin) ? self::createPax($model) : [],
                ];
                $isFirstCabin = false;
            }
        }

        return $arrayCabins;
    }
    private static function createExrtaService($model)
    {
        $arrayExtraServices=[];
        if($model->extra_service)
        {
            foreach ($model->extra_service as $service)
            {
                $service = (object)$service;
                if($service->code!='senuelo') {
                    $arrayExtraServices[] = [
                        'code' => $service->code,
                        'price' => $service->description,
                        'paxs' => [
                            'CHD' => $model->chd,
                            'ADT' => $model->adt,
                        ]
                    ];
                }
            }
        }
        return $arrayExtraServices;
    }
    private static function createPax($model)
    {
        $nameComplete = explode(' ', $model->name);
        $arrayPax[] = [
            'title_id' => ($model->title_id)?$model->title_id:1,
            'name' => (isset($nameComplete[0]) &&  strlen($nameComplete[0]) > 0) ? $nameComplete[0] : 'test',
            'last_name' => (isset($nameComplete[1]) &&  strlen($nameComplete[1]) > 0) ? $nameComplete[1] : 'book',
            'document_number' => "API",
            'country_id' => ($model->country_id) ? $model->country_id : 154,
            'city_id' => ($model->city_id) ? $model->city_id : 1124,
            'birthdate' => ($model->birthdate) ? $model->birthdate : '2000-01-01',
            'language_id' => ($model->language_id) ? $model->language_id : '1',
            'hotel_contact' => ($model->hotel_contact) ? $model->hotel_contact : '2222222222',
            'emergency_phone' => ($model->emergency_phone) ? $model->emergency_phone : '9999999999',
            'phone' => ($model->phone) ? $model->phone : '0000000000',
            'email' => ($model->email) ? $model->email : 'test@test.com',
        ];

        return $arrayPax;
    }

    public static function quoteInformationApi($token, $quote_id, $channel_id)
    {
        $config = self::recuperarModelo();
        $url = $config->url . '/' . $config->version;

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];
        $body = ['quote_id' => $quote_id, 'channel_id' => $channel_id];
        $client = ($config->ssl) ? new Client(['verify' => false]) :  new Client();
        $res = $client->request('GET', $url . '/availabilities/get-quote', [
            'query' => $body,
            'headers' => $headers
        ]);
        if ($res->getStatusCode() == '200') {
            return json_decode($res->getBody());
        }
        return '';
    }

//    public static function deleteQuoteApi(QuoteForm $model)
//    {
//        $config = self::recuperarModelo();
//        $url = $config->url_api . '/' . $config->version_api;
//
//        $headers = [
//            'Authorization' => 'Bearer ' . $model->token,
//            'Accept' => 'application/json',
//        ];
//
////        $client = new Client(['verify' => Yii::getAlias('@frontend') . '/models/certs/cacert.pem']);
//        $client = ($config->ssl_api) ? new Client(['verify' => false]) :  new Client();
//        $res = $client->request('GET', $url . $url . '/quotations/eliminar-pedido?id_pedido=' . $model->quote_id, [
//            'headers' => $headers
//        ]);
//        if ($res->getStatusCode() == '200') {
//            return json_decode($res->getBody());
//        }
//        return '';
//    }

//    public static function cancelQuoteApi(QuoteForm $model)
//    {
//        $config = self::recuperarModelo();
//        $url = $config->url_api . '/' . $config->version_api;
//
//        $headers = [
//            'Authorization' => 'Bearer ' . $model->token,
//            'Accept' => 'application/json',
//        ];
//
//        $client = ($config->ssl_api) ? new Client(['verify' => false]) :  new Client();
//        $res = $client->request('POST', $url . '/quotations/cancel-quote?id=' . $model->quote_id, [
//            'headers' => $headers
//        ]);
//        if ($res->getStatusCode() == '200') {
//            return json_decode($res->getBody());
//        }
//        return '';
//    }

}