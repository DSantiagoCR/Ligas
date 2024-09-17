<?php

namespace frontend\controllers;
use common\models\Configuration;
use common\models\Lead;
use common\models\form\QuoteForm;
use yii\web\Controller;
use Yii;

//require '../../common/ripcord/ripcord.php';
require '../../common/ripcord/ripcord.php';



class OdooController extends Controller
{
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
//        $url = 'http://localhost:1669';
//        $db = 'odoo16';
//        $username = 'lcaiza';
//        $password = 'lcaiza';
        $config = self::recuperarModelo();
        $url = $config->url;
        $db = $config->base;
        $username = $config->username;
        $password = $config->password;

        $common = \ripcord::client("$url/xmlrpc/2/common");
        $uid = $common->authenticate($db, $username, $password, array());
        $models = \ripcord::client("$url/xmlrpc/2/object");

        $id = $models->execute_kw($db, $uid, $password,
            'crm.lead', 'create', [[
                'name' => 'Nombre Lead',
                'email_from' => 'lead@correo.com',
                'mobile' => '0999078574',
                'description' => 'Proceso de Cotizador en linea',
                'user_id' => 2,
                'x_ship' => 'BAR003',
                'x_passenger' => 3,
                'x_adult' => 2,
                'x_child' => 1,
                'x_start_date' => '2023-02-01',
                'x_end_date' => '2023-02-28',
                'x_cruise_date' => '2023-02-16',
                'x_cod_prf' => '80648'
            ]]);

        $imageBase64 = base64_encode(file_get_contents('https://goware.net/administrator/downloads/quotes/80648.pdf'));
        $img = $models->execute_kw($db, $uid, $password,
            'ir.attachment',
            'create', [
                [
                    'res_model' => 'crm.lead',
                    'name' => '80648.pdf',
                    'res_id' => $id,
                    'type' => 'binary',
                    'mimetype' => 'application/pdf',
                    'datas' => $imageBase64
                ]
            ]
        );

        echo "<pre>";
        print_r($id);
        echo "<br>";
        print_r($img);
        echo "</pre>";
    }

    public static function recuperarModelo()
    {
        $config = Configuration::find()->where(['app'=>'odoo'])->one();
        return $config;
    }

    public static function insertLead(QuoteForm $quote, $html, $totales)
    {
        $methodPayment = '';
        $statusPayment = false;
        $config = self::recuperarModelo();
        if ($config && $config->status) {
            $url = $config->url;
            $db = $config->base;
            $username = $config->username;
            $password = $config->password;
            $link = $html->result;

            $common = \ripcord::client("$url/xmlrpc/2/common");
            $uid = $common->authenticate($db, $username, $password, array());
            $models = \ripcord::client("$url/xmlrpc/2/object");

            $cabins = "<ul>";
            $numeroCabinas = count($quote->cabins);
            for ($i = 0; $i < $numeroCabinas; $i++) {
                $cabins .= "<li>1 " . $quote->cabins[$i]['cabin_name'] . " (" . $quote->cabins[$i]['acomodation_text'] . ")</li>";
            }
            $cabins .= "</ul>";
            $id = $models->execute_kw($db, $uid, $password,
                'crm.lead', 'create', [[
                    'name' => $quote->name,
                    'email_from' => $quote->email,
                    'mobile' => $quote->phone,
                    'description' => 'Proceso de Cotizador en linea',
                    'user_id' => 2,
                    'x_ship' => $quote->ship_id,
                    'x_passenger' => ($quote->adt + $quote->chd),
                    'x_adult' => $quote->adt,
                    'x_child' => $quote->chd,
                    'x_start_date' => $quote->sailing_date,
                    'x_end_date' => $quote->sailing_end_date,
                    'x_cruise_date' => $quote->sailing_date,
                    'x_cod_prf' => $quote->cod_prf,
                    'x_reference' => ($quote->name.'x'.($quote->adt + $quote->chd)),
                    'x_cabins' => $cabins,
                    'x_total' => $totales->total,
                    'x_nationality' => (string)$quote->nationality,
                    'expected_revenue'=>$quote->total_cruce,
                    'x_status_payment'=>$statusPayment,
                    'x_method_payment'=>$methodPayment,
                    'medium_id'=>'1',
                    'source_id'=>'54',

                ]]);
            $imageBase64 = base64_encode(file_get_contents($link));
            $img = $models->execute_kw($db, $uid, $password,
                'ir.attachment',
                'create', [
                    [
                        'res_model' => 'crm.lead',
                        'name' => $quote->cod_prf . '.pdf',
                        'res_id' => $id,
                        'type' => 'binary',
                        'mimetype' => 'application/pdf',
                        'datas' => $imageBase64
                    ]
                ]
            );
            return ['lead_id' => $id, 'attachment_id' => $img];
        }
        return false;
    }

    public static function updateLead(Lead $model)
    {
        $config = self::recuperarModelo();
        $url = $config->url;
        $db = $config->base;
        $username = $config->username;
        $password = $config->password;

        $common = \ripcord::client("$url/xmlrpc/2/common");
        $uid = $common->authenticate($db, $username, $password, array());
        $models = \ripcord::client("$url/xmlrpc/2/object");

        $models->execute_kw($db, $uid, $password,
            'crm.lead', 'write', [
                [$model->odoo_id],
                [
                    'x_method_payment' => $model->type_payment,
                    'x_status_payment' => $model->payment
                ]
            ]);

        $imageBase64 = base64_encode(file_get_contents($model->document_payment));
        $name = ($model->external_id_payment) ? "p_" . $model->external_id_payment : "p_" . $model->cod_prf;
        $models->execute_kw($db, $uid, $password,
            'ir.attachment',
            'create', [
                [
                    'res_model' => 'crm.lead',
                    'name' => $name . '.pdf',
                    'res_id' => $model->odoo_id,
                    'type' => 'binary',
                    'mimetype' => 'application/pdf',
                    'datas' => $imageBase64
                ]
            ]
        );
    }
}