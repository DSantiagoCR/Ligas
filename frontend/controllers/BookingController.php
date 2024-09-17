<?php

namespace frontend\controllers;

use common\models\Agent;
use common\models\CabinImage;
use common\models\form\PriceCabin;
use common\models\Itinerary;
use common\models\Lead;
use common\models\PagoParametrosSantander;
use common\models\PagoSantander;
use common\models\Service;
use common\models\ServiceExtra;
use common\models\Ship;
use common\models\form\QuoteForm;
use common\models\Template;
use common\models\Years;
use frontend\config\ApiRedsys;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii;
use yii\web\Response;
use yii\helpers\Url;

class BookingController extends Controller
{
    public $layout = 'layoutBooking';

    public function init()
    {
        parent::init();
    }

    /**
     * @return array[]
     */
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(Yii::getAlias("@web") . '/booking/start');
    }
    public function actionStart()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), '');

        return $this->render('start', [
            'model' => $model
        ]);
    }
    public function actionStepForm()
    {
        $model = new QuoteForm(['scenario' => 'step-form']);
        $request = Yii::$app->request;
        $shipList = Ship::find()->all();
        $model->step = 2;
        $itineraryList = Itinerary::find()
            ->select("code, name")
            ->where(['<', 'nights', 5])
            ->andWhere(['status'=>true])
            ->distinct('code, name')
            ->all();
        $model->tokenValidate();

        Yii::$app->session->remove('model_general');
        Yii::$app->session->remove('html_nn');
        Yii::$app->session->remove('cabins');

        if ($model->load($request->post()) && $model->validate() && (($model->adt + $model->chd) < 10)) {
            $model->duration = $request->post('optionsCruiseDuration');
            return $this->redirect(array('step-availability', 'model' => $model));
        } else {
            if (!(($model->adt + $model->chd) < 10)){
                $model->addError('adt', 'The maximum quantity');
                $model->addError('chd', 'of passengers is 9');
            }
            if($request->get('model'))
            {
                $model->load($request->get(), 'model');
            }
            $model->duration = ($model->duration) ? $model->duration : 7;
            $model->adt = ($model->adt) ? $model->adt : 0;
            $model->chd = ($model->chd) ? $model->chd : 0;
            return $this->render('step-form', [
                'model' => $model,
                'shipList' => $shipList,
                'itineraryList' => $itineraryList
            ]);
        }
    }
    public function actionGetListItinerary()
    {
        $request = Yii::$app->request;
        $dias = $request->post('dias');
        $esDias = $request->post('esDias');

        return $this->getListItinerary($dias,$esDias);
    }
    public function getListItinerary($dias,$buscarDias)
    {
        $itineraryList = '';
        if($dias>0)
        {
            $itineraryList = Itinerary::find()
                ->select("code, name")
                ->where(['days'=> $dias])
                ->andWhere(['status'=>true])
                ->distinct('code, name')
                ->all();
        }
        else
        {
            $itineraryList = Itinerary::find()
                ->select("code, name")
                ->where(['<', 'nights', 5])
                ->andWhere(['status'=>true])
                ->distinct('code, name')
                ->all();
        }
        $arrayItinerary = yii\helpers\ArrayHelper::map($itineraryList,'code','name');

        return json_encode($arrayItinerary);
    }
    public function actionSummary()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), 'model');

        if(Yii::$app->session->has('extraServices'))
        {
            $model->extra_service  =   Yii::$app->session->get('extraServices');
        }

        $model = $this->valoresTktCggTax($model);

        if ($request->isPost){
            $model->load($request->post(), 'QuoteForm');

            $model->cgg = (isset($request->post('QuoteForm')['cgg'])) ? 1 : 0;
            $model->tax = (isset($request->post('QuoteForm')['tax'])) ? 1 : 0;
            $model->tkt = (isset($request->post('QuoteForm')['tkt'])) ? 1 : 0;
            $model = $this->valoresTktCggTax($model);


            if ($request->post('flag') == 1){
                return $this->redirect(array('quote', 'model' => $model));
            } elseif ($request->post('flag') == 2){
                return $this->redirect(array('hold', 'model' => $model));
            } else {
                return $this->redirect(array('method-payment', 'model' => $model));
            }
        }

        $prefijos = ApiRestController::titleListApi($model);
        $model = $this->valoresTktCggTax($model);
        return $this->render('step-cruice-summary', [
            'model' => $model,
            'prefijos'=>$prefijos,
        ]);
    }
    private function valoresTktCggTax($model)
    {
        // migratio control card
        $arrayDet = [];
        $val = $this->actionExtra('CGG', date('Y', strtotime($model->sailing_date)));
        $cgg = $val * ($model->adt + $model->chd);
        $arrayDet[]=['person'=>'Adt','value'=>$val];
        if($model->chd > 0):  $arrayDet[]=['person'=>'Chd','value'=>$val];  endif;
        $model->cgg_det = $arrayDet;

        // entrance fee to galapagos
        $arrayDet = [];
        $val = $this->actionExtra('TAX', date('Y', strtotime($model->sailing_date)), $model->nationality, 'ADT');
        $tax = ($val * $model->adt);
        $arrayDet[]=['person'=>'Adt','value'=>$val];
        $val = $this->actionExtra('TAX', date('Y', strtotime($model->sailing_date)), $model->nationality, 'CHD');
        $tax += ($val * $model->chd);
        if($model->chd > 0):  $arrayDet[]=['person'=>'Chd','value'=>$val];  endif;
        $model->tax_det =$arrayDet;

        $arrayDet = [];
        $val = $this->actionExtra('TKT', date('Y', strtotime($model->sailing_date)), $model->nationality, 'ADT');
        $tkt = ($val * $model->adt);
        $arrayDet[]=['person'=>'Adt','value'=>$val];
        $val = $this->actionExtra('TKT', date('Y', strtotime($model->sailing_date)), $model->nationality, 'CHD');
        $tkt += ($val * $model->chd);
        if($model->chd > 0):  $arrayDet[]=['person'=>'Chd','value'=>$val];  endif;
        $model->tkt_det = $arrayDet;

        $arrayDet = [];
        $val = $this->actionExtra('FEE TKT', date('Y', strtotime($model->sailing_date)), null, '','TKT');
        $tkt_fee = ($val * ($model->chd+$model->adt));
        $arrayDet[]=['person'=>'Adt','value'=>$val];
        if($model->chd > 0):  $arrayDet[]=['person'=>'Chd','value'=>$val];  endif;
        $model->tkt_fee_det = $arrayDet;


        $model->total_cruce = $model->cabin_total+
            (($model->tkt==1)?$tkt:$tkt_fee)+
            (($model->tax==1)?$tax:0)+
            (($model->cgg==1)?$cgg:0)
        ;

        $model->tkt_val = $tkt;
        $model->cgg_val = $cgg;
        $model->tax_val = $tax;
        $model->tkt_fee_val = $tkt_fee;
        return $model;
    }

    public function actionExtra($codigo, $anio, $nac_id = '', $tip_pax_id = '', $rela = ''){
        $model = ServiceExtra::find()
            ->where(['codigo' => $codigo, 'anio' => $anio])
            ->andFilterWhere(['nacionalidad_id' => $nac_id])
            ->andFilterWhere(['tipo_pax_id' => $tip_pax_id])
            ->andFilterWhere(['relacional' => $rela])
            ->one();

        return ($model) ? $model->valor : 0;
    }

    public function actionMethodPayment()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), 'model');
        $availability =[];
        if (Yii::$app->session->has('model_general')) {
            $model = Yii::$app->session->get('model_general');
            $model->cod_prf = strval($model->cod_prf);
            $model->description = strval($model->description);
            $model->load($model);
        }
        if ($model->validate()) {
            $availability[] = ApiRestController::quoteApi($model, 0);
        }

        $respuesta = (object)$availability[0];
        $model->quote_id = $respuesta->id;
        $html = ApiRestController::quoteInformationApi($model->token, $model->quote_id, 2);
        $aditionalInfo = ApiRestController::quoteInformationApi($model->token, $model->quote_id, 3);
        $model->cod_prf = $aditionalInfo->numero_nn;

        $lead = $this->createLead($model,$aditionalInfo,$html,2);

        $order = time();
        $idPagoSantarder = $this->saveRegisterSantanderPay($model,$order);
        $parametrosSantander = $this->setParameterSantander($model,$order,$idPagoSantarder,$lead);


        Yii::$app->session->set('model_general',$model);
        Yii::$app->session->set('html_nn',$html->result);
        return $this->render('booking-now-pay',[
            'model'=>$model,
            'parametrosSantander' => $parametrosSantander,
        ]);
    }
    public function actionPayNow()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), 'model');
        if (Yii::$app->session->has('model_general')) {
            $model = Yii::$app->session->get('model_general');
            $model->cod_prf = strval($model->cod_prf);
            $model->description = strval($model->description);
            $model->load($model);
        }

        $modelLead = Lead::findOne($model->lead_id);

        $order = time();
        $idPagoSantarder = $this->saveRegisterSantanderPay($model,$order);
        $parametrosSantander = $this->setParameterSantander($model,$order,$idPagoSantarder,$modelLead);


        Yii::$app->session->set('model_general',$model);
        Yii::$app->session->set('html_nn',$modelLead->html_link);
        return $this->render('booking-now-pay',[
            'model'=>$model,
            'parametrosSantander' => $parametrosSantander,
        ]);
    }
    private function asignaPagoTotalExtraService($model){
        $suma = 0;
        if($model->extra_service) {
            foreach ((object)$model->extra_service as $array) {
                $suma = $suma + ($array['description']);
            }
        }
        return $suma;
    }

    private function setParameterSantander($model,$order,$idPagoSantarder,$lead)
    {
        $modelParamSantander = PagoParametrosSantander::findOne(['status'=>true]);
        $miObj = new ApiRedsys();
        $montoPago = $model->total_cruce+$this->asignaPagoTotalExtraService($model);
        $entero = intval($montoPago);
        $decimal = round(($montoPago - intval($montoPago)) * 100);
        $decimal = str_pad($decimal, 2, "0", STR_PAD_LEFT);
        $url="payment/returnnotifypaymentcreditcard";
        $urlKO = Url::to(Yii::$app->urlManagerFrontend->createUrl(['/payment/detalle-pago-santanderko?'. 'id=' . $idPagoSantarder.'&lead_id='.$lead->id]), true);
        $urlOK = Url::to(Yii::$app->urlManagerFrontend->createUrl(['/payment/detalle-pago-santanderok?'. 'id=' . $idPagoSantarder.'&lead_id='.$lead->id]), true);

        $miObj->setParameter("DS_MERCHANT_AMOUNT", $entero . $decimal);
        $miObj->setParameter("DS_MERCHANT_ORDER",$order);
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$modelParamSantander->numero_comercio_tpv);
        $miObj->setParameter("DS_MERCHANT_CURRENCY",$modelParamSantander->moneda_terminal_tpv);
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$modelParamSantander->transaction_type_tpv);
        $miObj->setParameter('Ds_MERCHANT_PRODUCTDESCRIPTION', 'descripcion test web book ');
        $miObj->setParameter("DS_MERCHANT_TERMINAL",$modelParamSantander->numero_terminal_tpv);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
        $miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);
        $miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);
        $miObj->setParameter('Ds_Merchant_ConsumerLanguage',$modelParamSantander->ds_Merchant_ConsumerLanguage);

        $version = $modelParamSantander->version_tpv;
        $params = $miObj->createMerchantParameters();
        $signature = $miObj->createMerchantSignature($modelParamSantander->clave_secreta_encriptacion_tpv);
        $url = $modelParamSantander->url_pago_tpv;

        return (object)['version'=>$version,'param'=>$params,'signature'=>$signature,'url'=>$url];
    }
    private function saveRegisterSantanderPay($model,$order)
    {
        $modelPagoSantarder = new PagoSantander();
        $modelPagoSantarder->fec_create = date('Y-m-d H:i:s');
        $modelPagoSantarder->reference = ($model->reference)?$model->reference:($model->name.' X '.($model->chd+$model->adt));
        $modelPagoSantarder->monto = $model->cabin_total;
        $modelPagoSantarder->status = 'BEGIN';
        $modelPagoSantarder->order_id = $order;
        $modelPagoSantarder->pasarelaId = 0;
        $modelPagoSantarder->save();
        return $modelPagoSantarder->id;
    }
    public function actionHold()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), 'model');
        if (Yii::$app->session->has('model_general')) {
            $model = Yii::$app->session->get('model_general');
            $model->cod_prf = strval($model->cod_prf);
            $model->description = strval($model->description);
            $model->load($model);
        }
        if ($model->validate()) {
            $availability[] = ApiRestController::quoteApi($model, 0);
        }

        $respuesta = (object)$availability[0];
        $model->quote_id = $respuesta->id;
        $html = ApiRestController::quoteInformationApi($model->token, $model->quote_id, 2);
        $aditionalInfo = ApiRestController::quoteInformationApi($model->token, $model->quote_id, 3);
        $model->cod_prf = $aditionalInfo->numero_nn;

        $this->createLead($model,$aditionalInfo,$html,2);

        return $this->render('booking-now-hold',
            [
                'model'=>$model,
                'respuesta'=>$respuesta,
                'html'=>$html,
            ]
        );
    }

    public function actionStepAvailability()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), 'model');

        $shipList = Ship::find()->all();

        $itineraryList = Itinerary::find()
            ->select("code, name")
            ->where(['<', 'nights', 5])
            ->distinct('code, name')
            ->all();
        if($model->duration>1)
        {
            $itineraryList = Itinerary::find()
                ->select("code, name")
                ->where(['days'=> ($model->duration+1)])
                ->andWhere(['status'=>true])
                ->distinct('code, name')
                ->all();
        }
        $availability = null;

        if($model->duration == 1){
            $model->duration = 7;
            $availability[] = ApiRestController::availabilityApi($model);
            $model->duration = 4;
            $availability[] = ApiRestController::availabilityApi($model);
            $model->duration = 3;
            $availability[] = ApiRestController::availabilityApi($model);
            $model->duration = 1;
        } else {
            $availability[] = ApiRestController::availabilityApi($model);
        }
        if ($request->isPost){
            Yii::$app->session->remove('cabins');
            $model->load($request->post(), 'QuoteForm');
            $model->cabins = [];
            $model->cabin_total = 0;
            return $this->redirect(array('step-availability-cabins', 'model' => $model));
        }

        return $this->render('step-availability', [
            'model' => $model,
            'shipList' => $shipList,
            'itineraryList' => $itineraryList,
            'availability' => $availability
        ]);
    }
    public function actionStepAvailabilityCabins()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), 'model');
        $availabilityCabins = ApiRestController::cabinListApi($model);
        $cabins = array_reverse($availabilityCabins->cabins);

        if ($request->isPost){
            $model->cabins = Yii::$app->session->get('cabins');

            $model->cabin_total = $this->sumatoriaTotalPriceCabins($model->cabins );
            $model->adt = $this->sumatoriaTotalAdtCabins($model->cabins );
            $model->chd = $this->sumatoriaTotalChdCabins($model->cabins );
            $model->name_cabins = $this->concatNameCabins($model->cabins );
            Yii::$app->session->remove('cabins');
            $model->extra_service = '';
            Yii::$app->session->remove('extraServices');
            return $this->redirect(array('step-land-services', 'model' => $model));

        }
        /*trae todas las imagenes acorde al barco de cada cabina*/
        $cabinImages = CabinImage::find()
            ->alias('ci')
            ->innerJoinWith('cabin c')
            ->innerJoinWith('cabin.ship s')
            ->where(['s.status'=>true,'s.code'=>$model->ship_id])
            ->andWhere(['c.status'=>true])
            ->andWhere(['ci.status'=>true])
            ->orderBy(['ci.principal'=>SORT_ASC])
            ->asArray()
            ->all();
        Yii::$app->session->remove('cabins');

        return $this->render('step-availability-cabins', [
            'cabins' => $cabins,
            'model' => $model,
            'cabinImage'=>$cabinImages,
        ]);
    }
    public function actionStepLandServices()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), 'model');

        $year = Years::findOne(['name' => date('Y', strtotime($model->sailing_date)), 'status' => 1]);
        $num_pax = ($model->pax)?$model->pax:1;
        $servicesLand  = $this->getServices(1,$year->id,$model->ship_id);
        $servicesOnboards = $this->getServices(2,$year->id,$model->ship_id);

        $query = "select service_id,rate from service_rate where $num_pax between min_pax and max_pax";
        $con = yii::$app->db;
        $servicesRate = $con->createCommand($query)->queryAll();

        if($servicesLand ||   $servicesOnboards )
        {
            return $this->render('step-land-services', [
                'servicesLand' => $servicesLand,
                'servicesOnboards' => $servicesOnboards,
                'servicesRate'=>$servicesRate,
                'model' => $model,
            ]);
        }
        else
        {
            return $this->redirect(array('summary', 'model' => $model));
        }

    }
    private function getServices($tipo,$anio,$barco_id)
    {
        $ship_id = Ship::find()
            ->where(['code'=>$barco_id])
            ->andWhere(['status'=>true])
            ->one();

        $listServices = Service::find()
            ->where(['status' => 1, 'year_id' =>$anio, 'type_service_id' => $tipo])
            ->andWhere("ship_id = '' OR ship_id is null or ship_id = $ship_id->id")
            ->all();

        return $listServices;
    }
    public function actionGetItinerary()
    {
        $year = Years::findOne(['name' => date('Y'), 'status' => 1]);
        $request = Yii::$app->request;
        $ship = $request->post('ship');
        $itinerary = $request->post('itinerary');
        $modelItinerary = Itinerary::find()
            ->alias('i')
            ->innerJoinWith('ship s')
            ->where(['s.code'=>$ship])
            ->andWhere(['i.code'=>$itinerary])
            ->andWhere(['year_id'=>$year->id])
            ->asArray()
            ->one();
        return json_encode($modelItinerary);
    }

    public function actionQuote()
    {
        $model = new QuoteForm();
        $request = Yii::$app->request;
        $model->load($request->get(), 'model');
        if (Yii::$app->session->has('model_general')) {
            $model = Yii::$app->session->get('model_general');
            $model->cod_prf = strval($model->cod_prf);
            $model->description = strval($model->description);
            $model->load($model);
        }
        if ($model->validate()){
            $availability[] = ApiRestController::quoteApi($model,1);
        }

        $respuesta = (object)$availability[0];
        $model->quote_id = $respuesta->id;
        $html = ApiRestController::quoteInformationApi($model->token, $model->quote_id, 2);
        $aditionalInfo = ApiRestController::quoteInformationApi($model->token, $model->quote_id, 3);
        $model->cod_prf = $aditionalInfo->numero_nn;

        $this->createLead($model,$aditionalInfo,$html,1);

        return $this->render('booking-now-quote',
            [
                'model'=>$model,
                'respuesta'=>$respuesta,
                'html'=>$html,
            ]
        );
    }
    public function actionGetCabinsPrice()
    {
        $model = new PriceCabin();
        $request = Yii::$app->request;
        $model->load($request->get(), '');
        $availabilityCabins = ApiRestController::priceCabinApi($model);
        Yii::$app->response->format = Response::FORMAT_JSON;
        $contAdlChd = $this->contarAdtChd($model->acomodation_text.' / 0 Child');
        $availabilityCabins->detalle_pax = $this->addTypePaxToDetallePax($contAdlChd['Adults'],$contAdlChd['Children'],$availabilityCabins->detalle_pax);

        $cabin=['cabin_id'=>$model->cabin_id,
            'accommodation_id'=>$model->accommodation_id,
            'acomodation_text'=>$model->acomodation_text,
            'cabin_name'=>$model->cabin_name,
            'cabin_price'=>$availabilityCabins->price,
            'detalle_pax'=>$availabilityCabins->detalle_pax,
            'adt'=>$contAdlChd['Adults'],
            'chd'=>$contAdlChd['Children'],
            'available'=>$model->available,
            'code'=>$model->code,
        ];

        $permitirAddCabin = $this->verifyMaxAvailableByCabin($cabin);

        if($permitirAddCabin) {
            $this->assignCabins($cabin);
        } else {
            $availabilityCabins->price = 0;
        }
        return $availabilityCabins;
    }
    private function verifyMaxAvailableByCabin($arrayCabin)
    {
        /**Detalle: Metodo que devuelve true o false, si el numero maximo de cabinas permitidos,
         * por tipo de cabina no se ha superado, true= puede agregar, false = no puede agregar
         */

        $permitirAgregar = false;
        $available = $arrayCabin['available'];
        $code = $arrayCabin['code'];
        $contNumCabin = 0;
        $cabins= Yii::$app->session->get('cabins');
        if($cabins)
        {
            foreach ($cabins as $cabin)
            {
                if($cabin['code']==$code)
                {
                    $contNumCabin++;
                }
            }
        }
        if($available>$contNumCabin)
        {
            $permitirAgregar = true;
        }
        return $permitirAgregar;
    }
    private function addTypePaxToDetallePax($adt,$chd,$detalle_pax)
    {
        /**Detalle: Metodo que devuelve si el pasajero ingresados son Adults o Children, y los adjunta al arreglo de
         * detalles que ingresa, por acomodacion.
         */
        $detalle_pax2=[];
        $detalle_pax3=[];
        $arrayObj=[];
        $cont=0;
        for ($i=0;$i<$adt;$i++)
        {
            $detalle_pax2[]=['type'=>'Adult'];
        }
        for ($j=$adt;$j<($adt+$chd);$j++)
        {
            $detalle_pax2[]=['type'=>'Child'];
        }

        foreach ($detalle_pax as $dt)
        {
            $arrayObj['pax']=$dt->pax;
            $arrayObj['price'] = $dt->price;
            $arrayObj['type'] = $detalle_pax2[$cont++]['type'];
            $detalle_pax3[]= (object)$arrayObj;
        }
        return ((object)$detalle_pax3);
    }
    private function assignCabins($cabin)
    {
        $arrayCabins=[];
        if( Yii::$app->session->has('cabins'))
        {
            $arrayCabins = Yii::$app->session->get('cabins');
            if($arrayCabins)
            {
                array_push($arrayCabins, $cabin);
                Yii::$app->session->remove('cabins');
                Yii::$app->session->set('cabins',$arrayCabins);
            } else {
                $arrayCabins[] = $cabin;
                Yii::$app->session->set('cabins',$arrayCabins);
            }
        }
        else
        {
            $arrayCabins[] = $cabin;
            Yii::$app->session->set('cabins',$arrayCabins);
        }
    }
    private function sumatoriaTotalPriceCabins($arrayCabins)
    {
        $total = 0;
        if($arrayCabins)
        {
            foreach ($arrayCabins as $cabin)
            {
                $total = $total+$cabin['cabin_price'];
            }
        }
        return $total;
    }
    private function sumatoriaTotalAdtCabins($arrayCabins)
    {
        $total = 0;
        if($arrayCabins)
        {
            foreach ($arrayCabins as $cabin)
            {
                $total = $total+$cabin['adt'];
            }
        }
        return $total;
    }
    private function sumatoriaTotalChdCabins($arrayCabins)
    {
        $total = 0;
        if($arrayCabins)
        {
            foreach ($arrayCabins as $cabin)
            {
                $total = $total+$cabin['chd'];
            }
        }
        return $total;
    }
    private function concatNameCabins($arrayCabins)
    {
        $name_cabins = '';
        if($arrayCabins)
        {
            foreach ($arrayCabins as $cabin)
            {
                $name_cabins = $cabin['cabin_name'].','.$name_cabins;
            }
        }
        return $name_cabins;
    }
    private function contarAdtChd($acomodacion_text)
    {
        $arrayComodacion = explode('/',$acomodacion_text);
        $contAdt = $contChd = 0;
        $arrayAdt = [['1 Adult',1],['2 Adults',2],['3 Adults',3],['4 Adults',4]];
        $arrayChd = [['0 Child',0],['1 Child',1],['2 Children',2],['3 Children',3]];
        foreach ($arrayAdt as $dato)
        {
            if($dato[0]==ltrim(rtrim($arrayComodacion[0])))
            {
                $contAdt =  $contAdt +$dato[1];
            }
        }
        foreach ($arrayChd as $dato)
        {
            if($dato[0]==ltrim(rtrim($arrayComodacion[1])))
            {
                $contChd =  $contChd +$dato[1];
            }
        }
        return ['Adults'=>$contAdt,'Children'=>$contChd];
    }
    public function actionDeleteCabinsSelected()
    {
        $request = Yii::$app->request;
        $cabin_id = $request->get('cabin_id');
        $accommodation_id =$request->get('accommodation_id');
        $cabin_name = $request->get('cabin_name');
        $cabin_price =$request->get('cabin_price');
        $cabin=['cabin_id'=>$cabin_id,'accommodation_id'=>$accommodation_id,
            'cabin_name'=>$cabin_name,'cabin_price'=>$cabin_price];

        return $this->deleteCabins($cabin);
    }
    private function deleteCabins($cabin)
    {
        $entroSession = false;
        $encontro = false;
        $countArray = 0;
        $keyEliminado = '';
        $arrayCabinsNew=[];
        if( Yii::$app->session->has('cabins') )
        {
            $entroSession = true;
            $arrayCabins = Yii::$app->session->get('cabins');

            if(is_array($arrayCabins)  && count($arrayCabins)>0)
            {
                foreach ($arrayCabins as $key => $cabinX)
                {
                    if($cabinX['cabin_id']==$cabin['cabin_id'] &&
                        $cabinX['accommodation_id']==$cabin['accommodation_id'] &&
                        $cabinX['cabin_price']==$cabin['cabin_price'] )
                    {
                        unset($arrayCabins[$key]);
                        break;
                    }
                }
                Yii::$app->session->remove('cabins');
                Yii::$app->session->set('cabins',$arrayCabins);
            }
        }
        return json_encode([
            'encontro'=>$encontro,
            'count'=>$countArray,
            'keyEliminado'=>$keyEliminado,
            'entroSession'=>$entroSession,
            'array'=>$arrayCabinsNew]);
    }

    /****** BEGIN PROCESS ADD EXTRA SERVICE ********************************************/
    public function actionAddExtraService()
    {
        $request = Yii::$app->request;
        $model = new Service();
        $model->load($request->get(),'');
        $model->id = $request->get('id');
        $estado =  $request->get('status');
        $arrayExtraServices = [];

        $extra_ser=['id'=>$model->id,
            'code'=>$model->code,
            'name'=>$model->name,
            'duration'=>$model->duration,
            'path'=>$model->path,
            'description'=>$model->description,
        ];
        if($estado=='true') {
            $arrayExtraServices = $this->addExtraServices($extra_ser);
        } else {
            $arrayExtraServices = $this->deleteExtraService($extra_ser);
        }
    }
    private function addExtraServices($extra_ser)
    {
        $arrayExtraS=[];
        $esNuevo = true;
        if( Yii::$app->session->has('extraServices'))
        {
            $arrayExtraS = Yii::$app->session->get('extraServices');
            if(is_array($arrayExtraS))
            {
                foreach ($arrayExtraS as $item)
                {
                    if($item['id']==$extra_ser['id'] && $item['code']==$extra_ser['code'])
                    {
                        $esNuevo = false;
                    }
                }
                if($esNuevo)
                {
                    array_push($arrayExtraS, $extra_ser);
                    Yii::$app->session->remove('extraServices');
                    Yii::$app->session->set('extraServices',$arrayExtraS);
                }
            }
        }
        else
        {
            $arrayExtraS[] = $extra_ser;
            Yii::$app->session->set('extraServices',$arrayExtraS);
        }
        return $arrayExtraS;
    }
    private function deleteExtraService($arrayExtraServ)
    {

        if( Yii::$app->session->has('extraServices') )
        {
            $entroSession = true;
            $arrayES = Yii::$app->session->get('extraServices');

            if(is_array($arrayES)  && count($arrayES)>0)
            {
                foreach ($arrayES as $key => $cabinX)
                {
                    if($cabinX['id']==$arrayExtraServ['id'] &&
                        $cabinX['code']==$arrayExtraServ['code'])
                    {
                        unset($arrayES[$key]);
                        break;
                    }
                }
                Yii::$app->session->remove('extraServices');
                Yii::$app->session->set('extraServices',$arrayES);
            }
        }
        return $arrayES;
    }

    /****** END PROCESS END EXTRA SERVICE ********************************************/

    /****** BEGIN PROCESS ADD LEAD **************************************************/
    private function definirAgenteEncargado(){
        $agentes_lead = Lead::find()
            ->select("l.agente_id, count(*) total")
            ->alias('l')
            ->innerJoin('agent a','a.id = l.agente_id')
            ->where('l.agente_id is not null')
            ->andWhere('a.status = true')
            ->groupBy("l.agente_id")
            ->asArray()
            ->all();

      if (count($agentes_lead) > 1){
            $id = 0;
            foreach ($agentes_lead as $datos){
                if ($id == 0){
                    $id = $datos['total'];
                }
                if ($id > $datos['total']){
                    $id = $datos['total'];
                }
            }
            return $id;
        } else {
            $leads = Lead::find()
                ->select('l.agente_id')
                ->alias('l')
                ->innerJoin('agent a','a.id = l.agente_id')
                ->where('l.agente_id is not null')
                ->andWhere('a.status = true')
                ->groupBy('l.agente_id')
                ->asArray()
                ->one();
            if($leads)
            {
                $agentes = Agent::find()
                    ->where("id <> {$leads['agente_id']}")
                    ->andWhere(['status'=>true])
                    ->one();
            }else
            {
                $agentes = Agent::find()
                    ->where(['status'=>true])
                    ->one();
            }

            return ($agentes) ? $agentes->id : 1;
        }


//        if (!$agentes_lead){
//            return 1;
//        } elseif (count($agentes_lead) > 1){
//            $id = 0;
//            foreach ($agentes_lead as $datos){
//                if ($id == 0){
//                    $id = $datos['total'];
//                }
//                if ($id > $datos['total']){
//                    $id = $datos['total'];
//                }
//            }
//            return $id;
//        } else {
//            $leads = Lead::find()
//                ->select('l.agente_id')
//                ->alias('l')
//                ->innerJoin('agent a','a.id = l.agente_id')
//                ->where('l.agente_id is not null')
//                ->andWhere('a.status = true')
//                ->groupBy('l.agente_id')
//                ->asArray()
//                ->one();
//
//
//            $agentes = Agent::find()
//                ->where("id <> {$leads['agente_id']}")
//                ->andWhere(['status'=>true])
//                ->one();
//            return ($agentes) ? $agentes->id : 1;
//        }
        return null;
    }

    private function envioCorreoPlantillas($template_id, QuoteForm $model,$html){
        $template = Template::findOne($template_id);
        $template->cuerpo = str_replace('{pedido_id}', $model->quote_id, $template->cuerpo);
        $template->cuerpo = str_replace('{link_pedido_id}', $html->result,$template->cuerpo);
//        $template->cuerpo = str_replace('{link_pedido_id}', Yii::$app->urlManager->createAbsoluteUrl("?pedido_id=$model->quote_id"), $template->cuerpo);
        $lead = ($model->lead_id) ? Lead::findOne($model->lead_id) : Lead::findOne(['pedido_id' => $model->quote_id]);

        $mail = Yii::$app->mailer->compose()
            ->setFrom(['goware@gogalapagos.com'=>'GOGALAPAGOS'])
            ->setSubject($template->nombre)
            ->setTextBody("BOOK")
            ->setHtmlBody($template->cuerpo);

        $mail->setTo($model->email)
            ->setCc($lead->agente->correo)
            ->send();

//        if ($template_id != 3){
//            $mail->setTo($model->email)
//                ->setCc($lead->agente->correo)
//                ->send();
//        } else {
//            $mail->setTo($lead->agente->correo)->send();
//        }
    }

    private function createLead($model,$aditionalInfo,$html,$template)
    {
        $lead = new Lead();
        $model->description = $aditionalInfo->numero_nn;
        $lead->attributes = $model->attributes;
//        $odoo = OdooController::insertLead($model, $html, $aditionalInfo);
        $odoo = ['lead_id'=>1000];
        $lead->odoo_id = (int)$odoo['lead_id'];
//        $lead->estado_id = ($bandera) ? 2 : 3;
        $lead->estado_id = 2;
        $lead->start_date = $model->sailing_date;
        $lead->quote_model = json_encode($model->attributes);
        $lead->pedido_id = $model->quote_id;
        $lead->channel = 'book';
        $lead->total_payment = $model->total_cruce;//$aditionalInfo->total;
        $lead->agente_id = $this->definirAgenteEncargado();
        $lead->ip = Yii::$app->request->getUserIP();
        $lead->extra_services = json_encode(($lead->extra_services)?$lead->extra_services:'');
        $lead->cabins = json_encode(($lead->cabins)?$lead->cabins:'');
        $lead->totales = json_encode($aditionalInfo);
        $lead->created_at = date('Y-m-d H:i:s');
        $lead->sailing_end_date = $model->sailing_end_date;
        $lead->html_link = $html->result;
        if ($lead->validate())
        {
            if ($lead->save()) {
                $model->lead_id = $lead->id;
                //            $template_id = ($bandera) ? 2 : 1;
                $template_id = $template;
                $this->envioCorreoPlantillas($template_id, $model,$html);
            }
        }
        else
        {
            throw new \Exception("Ocurrio un error al Crear Lead");
        }
//      $numero_pedido = (!$lead->cod_prf) ? $lead->pedido_id : $lead->cod_prf;

        return $lead;
    }
    /****** END PROCESS ADD LEAD **************************************************/


}