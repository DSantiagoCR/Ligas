<?php

$this->title = 'Booking Now';
use yii\helpers\Url;
use yii\helpers\Html;
$this->registerJs($this->render('/evento/jquery.blockUI.js'));
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AaggGYFbvavyrYMbuw9TSwIQwsajHsr60UzMSVQwBrHhNSss3ww_7oj9fBbkMj2mTXbcpeIvPLk70dfe&currency=USD"></script>
<section class="bg-ocean">
    <div class="clouds disable-animation"></div>
    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>
    <picture class="animation-boat-step6"><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>
    <div class="container-steps width-1000">
        <h4 class="title-steps text-white">STEP 6 OF 6 - PAYMENT</h4>
        <div class="card" >
            <div class="card-body pb-0">
                <div class="max-height-content-tab pb-2">
                    <p class="fs-2 text-primary m-0 title-letter"><b>A</b>Purchase Summary</p>
                    <ul class="list-group list-group-flush border-bottom">
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="fs-3 m-0 pt-1 pb-1 text-black-50">Service</p>
                                <p class="fs-3 m-0 pt-1 pb-1 text-black-50">Price</p>
                            </div>
                        </li>
                    </ul>
                    <div class="accordion accordion-flush">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading1">

                                <button class="accordion-button collapsed flex-zm-justify" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse1"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapse1">
                                    <span class="fs-3 m-0 pt-1 pb-1 text-dark-blue">Cruise Total</span>
                                    <span class="fs-3 m-0 pt-1 pb-1 fw-bold text-dark-blue">$<?= $model->cabin_total?>
                                    </span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse1" class="accordion-collapse collapse"
                                 aria-labelledby="panelsStayOpen-heading1">
                                <?php
                                foreach ($model->cabins as $cabin)
                                {
                                    $cabin = (object)$cabin;
                                    ?>
                                    <div class="accordion-body">
                                        <div class="flex-zm-justify item-price-zm title">
                                            <p><b><?=$cabin->cabin_name?></b></p>
                                        </div>
                                        <?php
                                        foreach ($cabin->detalle_pax as $detalle)
                                        {
                                            $detalle = (object)$detalle;
                                            ?>
                                            <div class="flex-zm-justify item-price-zm">
                                                <p><b>Pax #<?= $detalle->pax?></b> <?=$detalle->type?></p>
                                                <p>Price <b>$<?= $detalle->price?>*</b></p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        $mostrarExtraService = false;
                        if(is_array($model->extra_service))
                        {
                            $mostrarExtraService = true;
                        }
                        ?>
                        <div class="accordion-item" <?= ($mostrarExtraService)?'style="display:inline"':'style="display:none" '?> >
                            <h2 class="accordion-header" id="panelsStayOpen-heading2">

                                <button class="accordion-button collapsed flex-zm-justify" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse2"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapse2">
                                    <span class="fs-3 m-0 pt-1 pb-1 text-dark-blue">Extra Services</span>
                                    <span class="fs-3 m-0 pt-1 pb-1 fw-bold text-dark-blue">
                                        <div class="">
                                                <?php
                                                $suma = 0;
                                                if($model->extra_service) {
                                                    foreach ((object)$model->extra_service as $array) {
                                                        $suma = $suma + ($array['description']);
                                                    }
                                                }
                                                ?>
                                              </div>
                                        $<span id="extra_service_value" ><?=$suma?></span>
                                    </span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse2" class="accordion-collapse collapse"
                                 aria-labelledby="panelsStayOpen-heading1">
                                <div class="accordion-body">
                                    <?php
                                    if($model->extra_service)
                                    {
                                        foreach ((object)$model->extra_service as $array)
                                        {
                                            if($array['description']>0)
                                            {
                                                ?>
                                                <div class="flex-zm-justify item-price-zm">
                                                    <p><b><?=$array['name']?></b></p>
                                                    <p>Price <b>$<?=$array['description']?>*</b></p>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(true)://$model->tkt==1):
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-heading3">

                                    <button class="accordion-button collapsed flex-zm-justify" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse3"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapse3">
                                    <span class="fs-3 m-0 pt-1 pb-1 text-dark-blue">
                                        <input id="txt_ticket_gps" name="QuoteForm[tkt]"
                                               class="form-check-input fix-checkbox-margin" type="hidden" value="" checked
                                        <!--                                            --><?php //echo ($model->tkt==1) ? 'checked' : ''; ?>
                                        Ticket round trip from Quito or Guayaquil to Galapagos</span>
                                        <span class="fs-3 m-0 pt-1 pb-1 fw-bold text-dark-blue">
                                        $<span id="ticket_gps_value"><?=($model->tkt==1)?$model->tkt_val:$model->tkt_fee_val?></span>
                                    </span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse3" class="accordion-collapse collapse"
                                     aria-labelledby="panelsStayOpen-heading2">
                                    <div id="div_acordion_tkt_fee" class="accordion-body"
                                        <?= ($model->tkt==1)? "style='display:none'":"style='display:inline'" ?>
                                    >
                                        <?php
                                        $cont=1;
                                        if($model->tkt_fee_det)
                                        {
                                            foreach ((object)$model->tkt_fee_det as $array)
                                            {
                                                if($array['person']=='Adt')
                                                {
                                                    for ($i=0;$i<$model->adt;$i++)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax#<?=$cont?> Adult (fee)</b></p>
                                                            <p>Price <b>$<span><?=$array['value']?></span>*</b></p>
                                                        </div>
                                                        <?php
                                                        $cont++;
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if($array['person']=='Chd')
                                                {
                                                    for ($j=0;$j<$model->chd;$j++)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax#<?=$cont?> Child (fee)</b></p>
                                                            <p>Price <b>$<span><?=$array['value']?></span>*</b></p>
                                                        </div>
                                                        <?php
                                                        $cont++;
                                                    }
                                                }

                                            }
                                        }
                                        ?>
                                    </div>
                                    <div id="div_acordion_tkt" class="accordion-body"
                                        <?= ($model->tkt==1)? "style='display:inline'":"style='display:none'" ?>
                                    >
                                        <?php
                                        $cont=1;
                                        if($model->tkt_det)
                                        {
                                            foreach ((object)$model->tkt_det as $array)
                                            {
                                                if($array['person']=='Adt')
                                                {
                                                    for ($i=0;$i<$model->adt;$i++)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax#<?=$cont?> Adult</b></p>
                                                            <p>Price <b>$<span><?=$array['value']?></span>*</b></p>
                                                        </div>
                                                        <?php
                                                        $cont++;
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if($array['person']=='Chd')
                                                {
                                                    for ($j=0;$j<$model->chd;$j++)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax#<?=$cont?> Child</b></p>
                                                            <p>Price <b>$<span><?=$array['value']?></span>*</b></p>
                                                        </div>
                                                        <?php
                                                        $cont++;
                                                    }
                                                }

                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endif;
                        ?>
                        <?php
                        if($model->tax==1):
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-heading4">

                                    <button class="accordion-button collapsed flex-zm-justify" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse4"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapse4">
                                    <span class="fs-3 m-0 pt-1 pb-1 text-dark-blue">
                                        <input id="txt_entrace" name="QuoteForm[tax]"
                                               class="form-check-input fix-checkbox-margin" type="hidden" value=""
                                            <?php echo ($model->tax==1) ? 'checked' : ''; ?>
                                        />
                                        Entrace fee to Galapagos</span>
                                        <span class="fs-3 m-0 pt-1 pb-1 fw-bold text-dark-blue">
                                        $<span id="entrace_value"><?=$model->tax_val?></span>
                                    </span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse4" class="accordion-collapse collapse"
                                     aria-labelledby="panelsStayOpen-heading1">
                                    <div id="div_tax_acordion_ok" class="accordion-body" <?= ($model->tax==1)? "style='display:inline'":"style='display:none'" ?>
                                    >
                                        <?php
                                        $cont=1;
                                        if($model->tax_det)
                                        {
                                            foreach ((object)$model->tax_det as $array)
                                            {
                                                if($array['person']=='Adt')
                                                {
                                                    for ($i=0;$i<$model->adt;$i++)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax#<?=$cont?> Adult</b></p>
                                                            <p>Price <b>$<span><?=$array['value']?></span>*</b></p>
                                                        </div>
                                                        <?php
                                                        $cont++;
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if($array['person']=='Chd')
                                                {
                                                    for ($j=0;$j<$model->chd;$j++)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax#<?=$cont?> Child</b></p>
                                                            <p>Price <b>$<span><?=$array['value']?></span>*</b></p>
                                                        </div>
                                                        <?php
                                                        $cont++;
                                                    }
                                                }

                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endif;
                        ?>
                        <?php
                        if($model->cgg==1):
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-heading5">

                                    <button class="accordion-button collapsed flex-zm-justify" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse5"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapse5">
                                    <span class="fs-3 m-0 pt-1 pb-1 text-dark-blue">
                                        <input id="txt_migration" name="QuoteForm[cgg]"
                                               class="form-check-input fix-checkbox-margin" type="hidden" value=""
                                            <?php echo ($model->cgg==1) ? 'checked' : ''; ?>
                                        >
                                        Migration control card</span>
                                        <span class="fs-3 m-0 pt-1 pb-1 fw-bold text-dark-blue">
                                        $<span id="migration_value"><?=$model->cgg_val?></span>
                                    </span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse5" class="accordion-collapse collapse"
                                     aria-labelledby="panelsStayOpen-heading1">
                                    <div id="div_cgg_acordion_ok" class="accordion-body" <?= ($model->cgg==1)? "style='display:inline'":"style='display:none'" ?>
                                    >
                                        <?php
                                        $cont = 1;

                                        if($model->cgg_det)
                                        {
                                            foreach ((object)$model->cgg_det as $array)
                                            {
                                                if($array['person']=='Adt')
                                                {
                                                    for ($i=0;$i<$model->adt;$i++)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax#<?=$cont?> Adult</b></p>
                                                            <p>Price <b>$<span><?=$array['value']?></span>*</b></p>
                                                        </div>
                                                        <?php
                                                        $cont++;
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if($array['person']=='Chd')
                                                {
                                                    for ($j=0;$j<$model->chd;$j++)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax#<?=$cont?> Child</b></p>
                                                            <p>Price <b>$<span><?=$array['value']?></span>*</b></p>
                                                        </div>
                                                        <?php
                                                        $cont++;
                                                    }
                                                }

                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="flex-zm-justify border-bottom p-2 px-2">
                            <p class="fs-2 m-0 fw-bold text-price">Total Price</p>
                            <p class="fs-2 m-0 fw-bold text-price">
                                $<span id="total_price_summary"><?= $model->total_cruce?></span>
                                *</p>
                        </div>
                    </div>
                    <p class="fs-2 text-primary m-0 title-letter mt-5"><b>B</b>Payment Method</p>
                    <p class="m-0 mt-3 mb-2">Select a payment method</p>
                    <div id="placeToPay" class="payment-method">
                        <picture><img src="<?= Url::to('@web/images/ecuadorian-payments.png') ?>" /></picture>
                        <p>Ecuadorian Payments <span>with Place to Pay</span></p>
                    </div>
                    <div id="santander" class="payment-method">
                        <picture><img src="<?= Url::to('@web/images/international-payments.png') ?>" /></picture>
                        <p>International Payments <span>with Santander</span></p>
                    </div>
                    <a class="col-12" type="button" style="text-decoration: none" data-toggle="collapse" data-target="#buttons-paypal" aria-expanded="false" aria-controls="buttons-paypal">
                        <div id="div_st" class="payment-method">
                            <picture><img src="<?= Url::to('@web/images/paypal-payments.png') ?>" /></picture>
                            <p>International Payments <span>with PayPal</span></p>
                        </div>
                    </a>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mtp-20 collapse" id="buttons-paypal">
                        <!--INPUT NECESARIO PARA PAY PAL-->
                        <input class="form-control payment-paypal" value=<?=0?> type="hidden">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
            <div class="scroll-down-content"><span><i class="bi bi-chevron-down"></i>Scroll for more
                    information</span></div>
        </div>
        <div class="d-grid gap-2 fix-size-btns-footer" >
            <?= Html::a('Back', ['summary','model'=>$model],
                ['title'=> '','class'=>'btn btn-outline-light btn-lg border-0','id'=>'btn_back'])?>
        </div>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
             id="offcanvasStep3" aria-labelledby="offcanvasStep3Label">
            <div class="offcanvas-body">
                <div class="border-bottom pb-2">
                    <h3 class="title-form text-primary border-bottom pb-3">SUMMARY</h3>
                    <p class="fs-4 fw-bold text-dark-blue m-0 pt-3">Galapagos Legend</p>
                    <p class="fs-5 fw-bold text-primary m-0">North -Central (A)</p>
                    <p class="text-primary m-0 pb-3 border-bottom">5 nights / 4 days cruise</p>
                    <div class="d-grid gap-2 pt-3 pb-3 border-bottom">
                        <button class="btn btn-outline-primary btn-lg" control-id="ControlID-13">View Itinerary</button>
                        <div class="info-item-zm">THU<span class="text-price fs-3 fw-bold">16</span>
                            APRIL 2023</div>
                    </div>
                    <p class="fs-4 fw-bold text-dark-blue m-0 pt-3">Legend Balcony Suite</p>
                    <div class="row g-3 mt-0">
                        <div class="col m-0 p-2">
                            <div class="info-item-zm d-block text-center"><span
                                    class="text-price fs-3 fw-bold d-block">2</span>
                                ADULTS</div>
                        </div>
                        <div class="col m-0 p-2">
                            <div class="info-item-zm d-block text-center"><span
                                    class="text-price fs-3 fw-bold d-block">$8.194*</span>CABIN PRICE</div>
                        </div>
                    </div>
                    <div class="flex-zm-justify item-price-zm">
                        <p><b>Pax #1</b> (Adult)</p>
                        <p>Price <b>$4.097*</b></p>
                    </div>
                    <div class="flex-zm-justify item-price-zm">
                        <p><b>Pax #1</b> (Adult)</p>
                        <p>Price <b>$4.097*</b></p>
                    </div>
                    <p class="fs-4 fw-bold text-dark-blue m-0 pt-3">Junior Suite</p>
                    <div class="row g-3 mt-0">
                        <div class="col m-0 p-2">
                            <div class="info-item-zm d-block text-center"><span
                                    class="text-price fs-3 fw-bold d-block">1</span>
                                CHILDREN</div>
                        </div>
                        <div class="col m-0 p-2">
                            <div class="info-item-zm d-block text-center"><span
                                    class="text-price fs-3 fw-bold d-block">$2.097*</span>CABIN PRICE</div>
                        </div>
                    </div>
                    <div class="flex-zm-justify item-price-zm">
                        <p><b>Pax #3</b> (Children)</p>
                        <p>Price <b>$2.097*</b></p>
                    </div>
                </div>
                <div class="flex-zm-justify p-0 pb-2 pt-2">
                    <p class="fs-5 m-0 fw-bold text-price">Estimated Price</p>
                    <p class="fs-4 m-0 fw-bold text-price">$10.291.00*</p>
                </div>
                <p class="m-0">* Average per guest.</p>
                <p class="m-0">* No tax included.</p>
                <p class="m-0">* Does not include local flight ticket.</p>
                <p class="m-0">* Taxes, fees and port expenses $120.00 USD.</p>
            </div>
            <div class="d-grid gap-2 p-3">
                <button class="btn btn-primary btn-lg">Change my cabins</button>
                <button class="btn btn-secondary btn-lg" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
            </div>
        </div>
    </div>

    <!--FORMULARIO PARA PLACE TO PAY-->
    <form id="formPlacetoPay" action="<?= Yii::getAlias("@web")?>/payment/place-to-pay" >
        <input type="hidden" name="reference" value="<?= $model->reference ?>"/>
        <input type="hidden" name="description" value="<?= $model->description ?>"/>
        <input type="hidden" name="document_number" value="<?= $model->document_number ?>"/>
        <input type="hidden" name="document_type" value="<?= $model->document_type ?>"/>
        <input type="hidden" name="name" value="<?= $model->name ?>"/>
        <input type="hidden" name="last_name" value="<?= $model->last_name ?>"/>
        <input type="hidden" name="email" value="<?= $model->email ?>"/>
        <input type="hidden" name="phone" value="<?= $model->phone ?>"/>
        <input type="hidden" name="city_name" value="<?= $model->city_name ?>"/>
        <input type="hidden" name="country_name" value="<?= $model->country_name ?>"/>
        <input type="hidden" name="token" value="<?= $model->token ?>"/>
        <input type="hidden" name="quote_id" value="<?= $model->quote_id ?>"/>
        <input id="hidden_total_cruce" type="hidden" name="total_cruce" value="<?= $model->total_cruce ?>"/>
        <input id="" type="hidden" name="lead_id" value="<?= $model->lead_id?>"/>
        <input id="" type="hidden" name="model" value="<?= serialize($model->cabins) ?>"/>

        $model->lead_id

    </form>

    <!--FORMULARIO PARA SANTANDER-->
    <!--    PROD-->
    <!--    <form id="formSantander" action="https://sis.redsys.es/sis/realizarPago" method="post">-->
    <!--    TEST-->
    <form id="formSantander" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="post">
        <input type="hidden" name="Ds_SignatureVersion" value="<?= $parametrosSantander->version; ?>"/>
        <input type="hidden" name="Ds_MerchantParameters" value="<?= $parametrosSantander->param; ?>"/>
        <input type="hidden" name="Ds_Signature" value="<?= $parametrosSantander->signature; ?>"/>
    </form>

</section>
<script>
    $(document).ready(function (){

        $( "#placeToPay" ).click(function() {
            mensajeProcesando();
            $( "#formPlacetoPay" ).submit();
            //event.preventDefault();
        });

        $( "#santander" ).click(function() {
            mensajeProcesando();
            $( "#formSantander" ).submit();
            //event.preventDefault();
        });
        /**P2 Suma el valor de EXTRA SERVICE al valor total, en el momneto de ingresar a la pantalla*/
        var valorExtraServ = parseFloat($('#extra_service_value').text());

        asigaPrecioTotal(true,valorExtraServ);
        /**P2 FIN*/

        //PAYPAL
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: cargarItems(),
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    cargarOrden(details);
                    //alert('Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }
        }).render('#paypal-button-container');

        function cargarItems(){
            var payment = [];
            var total = parseInt($("#total_price_summary").text());
            var producto = '';

            $('.payment-paypal').each(function () {
                var valor = parseFloat($(this).val());
                if (valor > 0) {
                    total += parseFloat($(this).val());
                    producto += $(this).data('description') + ', ';
                }
            });
            payment[0] = {
                description: producto.substr(0, producto.length - 2),
                amount: {
                    currency_code: "USD",
                    value: total
                }
            };
            return payment;
        }

        function cargarOrden(details) {
            var detalle_pago = [];
            var cont = 0;
            $('.payment-paypal').each(function () {
                var valor = parseFloat($(this).val());
                if (valor > 0) {
                    detalle_pago[cont] = {
                        id: $(this).data('id'),
                        value: parseFloat($(this).val()),
                        servicio: $(this).data('description'),
                        origen: 'payment-kt',
                    };

                    cont++;
                }
            });
            var data = {
                detalle_pago: detalle_pago,
                details: details
            };
            $.isLoading({text: "<?= Yii::t('app', '_sendingemail') ?>"});
            $.ajax({
                url: '/url-retorno',
                type: 'POST',
                dataType: 'JSON',
                async: true,
                data: data,
                success: function (data) {
                    if (details.status == 'COMPLETED') {
                        $.isLoading("hide");
                        msnPayPal('<?= html_entity_decode(Yii::t('app', 'msnNotifyPayPal'), ENT_QUOTES, "UTF-8") ?>');
                    }

                    return data;
                }
            });
        }
        /** P1: proceso para cambiar los valores del total al dar click en los checkbox */
        $("#txt_ticket_gps").click(function() {
            var nuevo_valor = 0;
            var estaActivado = false;
            estaActivado = $("#txt_ticket_gps").prop("checked");
            nuevo_valor = parseInt($("#ticket_gps_value").text());
            asigaPrecioTotal(estaActivado,nuevo_valor);
        });
        $("#txt_entrace").click(function() {
            var nuevo_valor = 0;
            var estaActivado = false;
            estaActivado = $("#txt_entrace").prop("checked");
            nuevo_valor = parseInt($("#entrace_value").text());
            asigaPrecioTotal(estaActivado,nuevo_valor)
        });
        $("#txt_migration").click(function() {
            var nuevo_valor = 0;
            var estaActivado = false;
            estaActivado = $("#txt_migration").prop("checked");
            nuevo_valor = parseInt($("#migration_value").text());
            asigaPrecioTotal(estaActivado,nuevo_valor)
        });

        function asigaPrecioTotal(estaActivado,nuevo_valor)
        {
            var total_price = parseInt($("#total_price_summary").text());
            $("#total_price_summary").text(total_price);
            if(estaActivado) {
                total_price =total_price + nuevo_valor;
            } else {
                total_price = total_price - nuevo_valor
            }
            $("#total_price_summary").text(total_price);
            $("#hidden_total_cruce").val(total_price); /** valor para place to pay*/
        }
        /** FIN P1*/


    });
    function mensajeProcesando()
    {
        $.blockUI({
            message: 'Processing please wait...'
        });
    }
    $('#btn_back').click(function () {
        mensajeProcesando();
    })
</script>