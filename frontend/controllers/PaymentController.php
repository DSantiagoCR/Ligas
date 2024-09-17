<?php

namespace frontend\controllers;

use common\models\Agent;
use common\models\Lead;
use common\models\PagoParametrosPlacetopay;
use common\models\PagoParametrosSantander;
use common\models\PagoSantander;
use frontend\config\ApiRedsys;
use http\Params;
use Yii;
use common\models\PagoPlacetopay;
//use yii\httpclient\Client;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\models\form\QuoteForm;
use yii\web\UploadedFile;
use GuzzleHttp\Client;

//require '../config/apiRedsys.php';

class PaymentController extends Controller
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
    /****************************** BEGIN PROCESS PAYMENT PAYPAL ****************************************************/
    public function actionPayPal()
    {
        $request = Yii::$app->request;
        $model = new QuoteForm();
        $model->load($request->get(),'model');

        return $this->render('paypal',
            [
                'model'=>$model
            ]
        );
    }
    /****************************** END PROCESS PAYMENT PAYPAL **************************************************/
    /****************************** BEGIN PROCESS PAYMENT SANTANDER ************************************************/
    public function actionSantander()
    {
        $request = Yii::$app->request;
        $model = new QuoteForm();
        $model->load($request->get(),'model');

        $order = time();
        $idPagoSantarder = $this->saveRegisterSantanderPay($model,$order);
        $parametros = $this->setParameterSantander($model,$order,$idPagoSantarder);
        $flag = true;

        $this->updateRegisterSantanderPay($idPagoSantarder,'inicio',
            (object)['version'=>$parametros->version,
                'param'=>$parametros->param,
                'signature'=>$parametros->signature,
            ]);

        return $this->render('santander',
            [
                'model'=>$model,
                'version'=>$parametros->version,
                'params'=>$parametros->param,
                'signature'=>$parametros->signature,
                'url'=>$parametros->url,
            ]
        );
    }
    private function setParameterSantander($model,$order,$idPagoSantarder)
    {
        die('entro');
        $modelParamSantander = PagoParametrosSantander::findOne(['tipo_credenciales'=>'test']);
        $miObj = new ApiRedsys();
        $montoPago = $model->total_cruice;
        $entero = intval($montoPago);
        $decimal = round(($montoPago - intval($montoPago)) * 100);
        $decimal = str_pad($decimal, 2, "0", STR_PAD_LEFT);
        $url="payment/returnnotifypaymentcreditcard";
//        $urlKO = Url::to(Yii::$app->urlManagerFrontend->createUrl(['/book/payment/detalle-pago-santanderko?'. 'id=' . $idPagoSantarder]), true);
//        $urlOK = Url::to(Yii::$app->urlManagerFrontend->createUrl(['/book/payment/detalle-pago-santanderok?'. 'id=' . $idPagoSantarder]), true);
        $urlKO = Url::to(Yii::$app->urlManagerFrontend->createUrl(['/payment/detalle-pago-santanderko?'. 'id=' . $idPagoSantarder]), true);
        $urlOK = Url::to(Yii::$app->urlManagerFrontend->createUrl(['/payment/detalle-pago-santanderok?'. 'id=' . $idPagoSantarder]), true);


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
    private function updateRegisterSantanderPay($id,$tipoUpdate,$param)
    {
        if($tipoUpdate=='inicio')
        {
            $modelPagoSantarder = PagoSantander::findOne($id);
            $modelPagoSantarder->fec_update = date('Y-m-d H:i:s');
            $modelPagoSantarder->version = $param->version;
            $modelPagoSantarder->param = $param->param;
            $modelPagoSantarder->signature = $param->signature;
        }
        $modelPagoSantarder->save();
    }
    public function actionDetallePagoSantander()
    {
        $request = Yii::$app->request;
        $params = explode('&', base64_decode(explode('?', $request->url)[1]));
        $id = explode('=', $params[0])[1];
        $model = PagoSantander::findOne($id);

        //$this->layout = 'main-payment';
        return $this->render('detallePago', [
            'model' => $model,
            'bandera' => true,
        ]);
    }
    public function actionDetallePagoSantanderok($id,$lead_id)
    {
        $this->redireccionamientoSantander($id,$lead_id, 'Confirmation');
    }

    public function actionDetallePagoSantanderko($id,$lead_id)
    {
        $this->redireccionamientoSantander($id, $lead_id,'Cancelled');
    }
    protected function redireccionamientoSantander($id,$lead_id, $estado)
    {
        $pago = PagoSantander::findOne($id);
        $pago->status = $estado;
        $pago->fec_update = date('Y-m-d H:i:s');
        $pago->save();

        $lead = Lead::findOne($lead_id);

        $lead->payment = ($estado=='Confirmation')?1:0;
        $lead->type_payment = 'santander';
        $lead->updated_at = date('Y-m-d H:i:s');
        $lead->save();

        if (Yii::$app->session->has('model_general')) {
            $model = Yii::$app->session->get('model_general');
            $model->cod_prf = strval($model->cod_prf);
            $model->description = strval($model->description);
            $model->load($model);
        }

        $title = "TRANSACTION PAYMENT CREDIT CARD";
        Yii::$app->mailer->compose()
//            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['system-name-go'] . ' ' . Yii::$app->params['system-name-ware']])
            ->setFrom(['goware@gogalapagos.com'=>'GOGALAPAGOS'])
            ->setTo($model->email)
            ->setCc($lead->agente->correo)
            ->setSubject($title)
            ->setHtmlBody("<div> METHOD PAYMENT: Santander,  TRANSACTION STATUS: $estado </div>")
            ->send();

        $html = (Yii::$app->session->has('html_nn'))?Yii::$app->session->get('html_nn'):'#';

        echo $this->render('payment-congratulation', [
            'model' => $model,
            'html'=>$html,
        ]);

//        return $this->redirect(['/payment/detalle-pago-santander?' . base64_encode('id=' . $pago->id)]);

    }

    /****************************** END PROCESS PAYMENT SANTANDER ***************************************************/
    /****************************** BEGIN PROCESS PAYMENT PLACE TO PAY **********************************************/
    public function actionPlaceToPay1()
    {
        $request = Yii::$app->request;
        $model = new QuoteForm();
        $model->load($request->get(),'model');

        return $this->render('placetopay',
            [
                'model'=>$model
            ]
        );
    }
    public function actionPlaceToPay()
    {
        $request = Yii::$app->request;
        $model = new QuoteForm();
        $model->load($request->get(),'');

        $client = new Client(['verify'=>false]);
        $order = time();
        $idPagoPlace= $this->saveRegisterPlaceToPay($model,$order);
        $data=$this->setParameterPlaceToPlay($model,$idPagoPlace);

        $response = $client->post('https://checkout.placetopay.ec/api/session', [
            'json' => $data,
        ]);

        if ($response->getStatusCode()==200)
        {
            $lead = Lead::findOne($model->lead_id);
            $dataResponse = json_decode($response->getBody(), true);
            $lead->external_id_payment = strval($dataResponse['requestId']);
            $lead->type_payment = 'placetopay';
            $lead->save();
            $this->updateRegisterPlaceToPay($idPagoPlace,'inicio',$dataResponse['processUrl'],$dataResponse['requestId']);
            return $this->redirect($dataResponse['processUrl']);
        } else {
            return print_r($response);
        }
    }
    private function setParameterPlaceToPlay($model,$idPagoPlace)
    {
        $auth = $this->authModel();
        $NuevaFecha = strtotime('+18 minute', strtotime($auth['seed']));
        $ExpiracionFecha = date('Y-m-d H:i:s', $NuevaFecha);
//      $totales = ApiRestController::quoteInformationApi($model->token, $model->quote_id, 3);
//        $url = Url::to(Yii::$app->urlManagerFrontend->createUrl(["/book/payment/detalle-pago?".base64_encode('id=' . $idPagoPlace)]));

        $data = [
            'auth' => $auth,
            'payment' => [
                'reference' =>$model->name.'X'.($model->chd+$model->adt),
                'description' => ($model->description)?$model->description:'GOGALAPAGOS',
                'amount' => [
                    'currency' => 'USD',
                    'total' => ($model->total_cruce)?$model->total_cruce:1,//$totales->total,
                ],
            ],
            'buyer' => [
                'document' => $model->document_number,
                'documentType' => $model->document_type,
                'name' => ($model->document_type == 'CI') ? $model->name : $model->names,
                'surname' => $model->last_name,
                'email' => $model->email,
                'mobile' => $model->phone,
                'address' => [
                    'city' => $model->city_name,
                    'street' => $model->street,
                ],
            ],
            'expiration' => $ExpiracionFecha,
//            'returnUrl' => Url::to(Yii::$app->urlManagerFrontend->createUrl(["/payment/detalle-pago-placetopay?quote=$numero_pedido&lead=$lead->id"]), true),
//            'returnUrl' => Url::to(Yii::$app->urlManagerFrontend->createUrl(["/book/payment/detalle-pago?".base64_encode('id=' . $idPagoPlace)]), true),
//            'returnUrl' => Url::to(Yii::$app->urlManagerFrontend->createUrl(["/book/booking/hold"]), true),
//            'returnUrl' => Url::to(Yii::$app->urlManagerFrontend->createUrl(["/booking/hold"]), true),
            'returnUrl' => Url::to(Yii::$app->urlManagerFrontend->createUrl(["/payment/detalle-pago?lead_id=$model->lead_id&idPagoPlace=$idPagoPlace"]), true),
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
            'userAgent' => $_SERVER['HTTP_USER_AGENT']
        ];
        return $data;
    }
    private function saveRegisterPlaceToPay($model,$order)
    {
        $modelPagoPlace = new PagoPlacetopay();
        $modelPagoPlace->request_id = "";
        $modelPagoPlace->reference = ($model->reference)?$model->reference:($model->name.'X'.($model->chd+$model->adt));
        $modelPagoPlace->status = 'BEGIN';
        $modelPagoPlace->monto = $model->total_cruce;
        $modelPagoPlace->pasarela_id = 0;
        $modelPagoPlace->fec_create = date('Y-m-d H:i:s');
        $modelPagoPlace->save();

        return $modelPagoPlace->id;
    }
    private function updateRegisterPlaceToPay($id,$tipoUpdate,$url,$requestId)
    {
        if($tipoUpdate=='inicio')
        {
            $modelPago = PagoPlacetopay::findOne($id);
            $modelPago->fec_update = date('Y-m-d H:i:s');
            $modelPago->process_url = $url;
            $modelPago->request_id = $this->extraerRequestIdPlace($url);
            $modelPago->pasarela_id = $requestId;
            $modelPago->save();
        }

    }
    private function extraerRequestIdPlace($url)
    {
        $array = explode('/',$url);
        $cont = 0;
        if($array):
            foreach ($array as $dato)
            {
                if($dato=='session')
                {
                    return $array[$cont+1];
                }
                $cont++;
            }
        endif;
        return '0';
    }
    protected function authModel()
    {
        $modelParamPlaceToPay = PagoParametrosPlacetopay::findOne(['type'=>'auth']);
        $seed = date('c');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        $nonceBase64 = base64_encode($nonce);
        $tranKey = base64_encode(sha1($nonce . $seed . $modelParamPlaceToPay->secretKey, true));
        $auth = [
            'login' => $modelParamPlaceToPay->login,
            'seed' => $seed,
            'nonce' => $nonceBase64,
            'tranKey' => $tranKey,
        ];
        return $auth;
    }
//    public function actionDetallePago($lead_id,$idPagoPlace)
//    {
//        $request = Yii::$app->request;
//        $params = explode('&', base64_decode(explode('?', $request->url)[1]));
//        $reference = explode('=', $params[0])[1];
//        $id = explode('=', $params[0])[1];
////        $model = PagoPlacetopay::findOne(['reference'=>$reference]);
//        $model = PagoPlacetopay::findOne($idPagoPlace);
//
//        if (sizeof($params) == 2){
//            $response = $this->getPaymentInfo($model->request_id);
//            if ($response->isOk) {
//                if ($response->data['status']['status'] != 'PENDING') {
//                    $model->block = false;
//                }
//                $model->fec_update = date('Y-m-d H:i:s');
//                $model->status = $response->data['status']['status'];
//                $model->message = $response->data['status']['message'];
//                $model->save();
//            } else {
//                return print_r($response->data);
//            }
//        }
////        $this->layout = 'main-payment';
//        return $this->render('resumePayment', [
//            'model' => $model,
//        ]);
//    }
    public function actionDetallePago($lead_id,$idPagoPlace)
    {
        $request = Yii::$app->request;
//        $params = explode('&', base64_decode(explode('?', $request->url)[1]));
//        $reference = explode('=', $params[0])[1];
//        $id = explode('=', $params[0])[1];

        $model = PagoPlacetopay::findOne($idPagoPlace);
        $lead = Lead::findOne($lead_id);
        $response = $this->getPaymentInfo($model->request_id);
        if ($response->getStatusCode()==200)
        {
            $dataResponse = json_decode($response->getBody(), true);
            if ($dataResponse['status']['status'] != 'PENDING')
            {
                    $model->block = false;
            }
            $model->fec_update = date('Y-m-d H:i:s');
            $model->status = $dataResponse['status']['status'];
            $model->message = $dataResponse['status']['message'];
            $model->save();

            $title = "TRANSACTION PAYMENT";

            $modelGeneral = Yii::$app->session->get('model_general');
            Yii::$app->mailer->compose()
                ->setFrom(['goware@gogalapagos.com'=>'GOGALAPAGOS'])
                ->setTo($modelGeneral->email)
                ->setCc($lead->agente->correo)
                ->setSubject($title)
                ->setHtmlBody("<div> METHOD PAYMENT: PLACETOPAY,  TRANSACTION STATUS: $model->status </div>")
                ->send();

        }
        else
        {
            return print_r($response->data);
        }

        $html = (Yii::$app->session->has('html_nn'))?Yii::$app->session->get('html_nn'):'#';
        $model = Yii::$app->session->get('model_general');
        echo $this->render('payment-congratulation', [
            'model' => $model,
            'html'=>$html,
        ]);
    }
    protected function getPaymentInfo($request_id)
    {
        $auth = $this->authModel();
        $client = new Client(['verify'=>false]);
        $data = [
            'auth' => $auth
        ];
        $response = $client->post('https://checkout.placetopay.ec/api/session/' . $request_id, [
            'json' => $data,
        ]);
        return $response;
    }


    public function actionDetallePagoPlacetopay($result, $source, $quote, $lead)
    {
        $request = Yii::$app->request;

        $leadModel = Lead::findOne($lead);
        $tipo = $img ='';

        $response = $this->getPaymentInfo($leadModel->external_id_payment);
        if ($response->isOk) {
            $tipo = $response->data['status']['status'];
        } else {
            return print_r($response->data);
        }

        return $this->render('result-payment', [
            'img' => $img,
            'status' => $tipo,
            'model' => $leadModel,
        ]);
    }

    /****************************** END PROCESS PAYMENT PLACE TO PAY ************************************************/
//    public function actionDetallePago($result, $source, $quote, $lead)
//    {
//        $request = Yii::$app->request;
//
//        $leadModel = Lead::findOne($lead);
//        $tipo = $img ='';
//        if ($result == 1){
//            $tipo = 'REJECTED';
//        } elseif ($result == 2){
//            $tipo = 'APPROVED';
//        } else {
//            $response = $this->getPaymentInfo($leadModel->external_id_payment);
//            if ($response->isOk) {
//                $tipo = $response->data['status']['status'];
//            } else {
//                return print_r($response->data);
//            }
//        }
//
//        if ($result == 1 || $tipo == 'REJECTED'){
//            $img = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ42-m-EVLlUidfpJ65kjD-G8VG_BtTzzbJMQ&usqp=CAU';
//        } else {
//            $leadModel->payment = 1;
//            $leadModel->estado_id = 1;
//            $img = 'data:image/jpeg;base64,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';
//        }
//
//        $leadModel->type_payment = (!$leadModel->type_payment) ? 'santander' : $leadModel->type_payment;
//        $leadModel->save();
//
//        if ($request->post()){
//            if ($leadModel->load($request->post()) && $leadModel->validate()){
//                $leadModel->imageFile = UploadedFile::getInstance($leadModel, 'imageFile');
//                if ($leadModel->imageFile){
//                    if (!$leadModel->upload()) {
//                        throw new \Exception('No se pudo guardar la imagen');
//                    }
//                }
//                if (!$leadModel->save(false)){
//                    throw new \Exception('Error' . $leadModel->getErrors());
//                }
//                OdooController::updateLead($leadModel);
//            }
//        } else {
//            Yii::$app->mailer->compose()
//                ->setFrom('lcaiza@gogalapagos.com')
//                ->setTo($leadModel->agente->correo)
////                ->setCc('sistema3@gogalapagos.com')
//                ->setSubject('Proceso de Pago Quote')
//                ->setHtmlBody("<div>Pago realizado desde: ". strtoupper($source) ."</div><div>Profroma numero: $quote </div><div>Resultado: $tipo</div>")
//                ->send();
//        }
//
//        return $this->render('result-payment', [
//            'img' => $img,
//            'status' => $tipo,
//            'model' => $leadModel,
//        ]);
//    }





}
