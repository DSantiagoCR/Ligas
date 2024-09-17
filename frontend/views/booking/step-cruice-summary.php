<?php
$this->title = 'Booking Now';
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
$this->registerJs($this->render('/evento/jquery.blockUI.js'));
?>

<section class="bg-ocean">
    <?php
    $form = ActiveForm::begin([
        'id' => 'form-quote',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 0, 'deviceSize' => ActiveForm::SIZE_LARGE]
    ]);
    ?>


    <div class="clouds disable-animation"></div>
    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>
    <picture class="animation-boat-step5"><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>
    <div class="container-steps width-1000">
        <div class="head-box-flex">
            <h4 class="title-steps text-white">STEP 5 OF 6 - SUMMARY</h4>
            <button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStep3"
                    aria-controls="offcanvasStep3">My Selection</button>
        </div>
        <div class="card">
            <div class="card-body pb-0">
                <div class="max-height-content-tab pb-2">
                    <p class="fs-5 text-primary m-0 title-letter"><b>A</b>Cruise Summary</p>
                    <ul class="list-group list-group-flush border-bottom">
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Cruise Date</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue"><?= $model->sailing_date ?></p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Ship</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue"><?= ($model->ship_id != 'BAR003') ? 'Yatchs' : 'Galapagos Legend' ?></p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Itinerary</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue">

                                    <span id="itineray_<?= $model->out_id ?>"  class="fw-normal text-primary" data-bs-toggle="modal" data-bs-target="#itineraryModal"
                                          data-bs-itinerary="<?= $model->itinerary ?>" data-bs-ship="<?= $model->ship_id?>">
                                        <a href="#" class="fw-normal text-primary">(View Expedition)</a>
                                    </span>
                                    <?=($model->getItinerary())?$model->getItinerary()->name:'Itinerary '.$model->itinerary?>
                                </p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Cruise Length</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue"><?=$model->duration + 1?> days cruise</p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Guests</p>
                                <?php
                                $sufijoAdt = ($model->adt==1)?'Adult':'Adults';
                                $sufijoChd = ($model->chd<2)?'Child':'Children';
                                ?>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue"><?=$model->adt.' '.$sufijoAdt?> , <?=$model->chd.' '.$sufijoChd?> </p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Cabins</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue"><?=substr($model->name_cabins,0,strlen($model->name_cabins)-1) ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="accordion accordion-flush">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading1">
                                <button class="accordion-button collapsed flex-zm-justify" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse1"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapse1">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue">Cruise Rate</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$<?= ($model->cabin_total)?number_format($model->cabin_total, 2, ',', '.'):0;?>
                                    </span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse1" class="accordion-collapse collapse"
                                 aria-labelledby="panelsStayOpen-heading1">
                                <?php
                                if($model->cabins)
                                {
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
                                                    <p>Price <b>$<?= number_format($detalle->price,2,',','.')?>*</b></p>
                                                </div>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <div class="accordion-body">
                                        <div class="flex-zm-justify item-price-zm title">
                                            <p><b></b></p>
                                        </div>
                                        <div class="flex-zm-justify item-price-zm">
                                            <p><b>Pax #0</p>
                                            <p>Price <b>$0*</b></p>
                                        </div>
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
                                <button id="btn_extra_service_value" class="accordion-button collapsed flex-zm-justify" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse2"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapse2">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue">Extra Services</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">
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
                                            if(intval($array['description'])>0)
                                            {
                                                ?>
                                                <div class="flex-zm-justify item-price-zm">
                                                    <p><b><?=$array['name']?></b></p>
                                                    <p>Price <b>$<span id = "txt_extra_serv_<?=$array['id']?>">
                                                        <?=$array['description']?></span>*</b></p>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading3">
                                <button id="btn_ticket_gps" class="accordion-button collapsed flex-zm-justify" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse3"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapse3">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue">
                                        <input id="txt_ticket_gps" name="QuoteForm[tkt]" class="form-check-input
                                        fix-checkbox-margin suma_al_total" type="checkbox"
                                               <?php echo ($model->tkt==1) ? 'checked' : ''; ?>
                                        >
                                        Ticket round trip from Quito or Guayaquil to Galapagos
                                    </span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$
                                        <span id="ticket_gps_value"><?=($model->tkt==1)?$model->tkt_val:$model->tkt_fee_val?></span>
                                        <span id="ticket_gps_org_value" style="display:none"><?=($model->tkt_val)?$model->tkt_val:0?></span>
                                        <span id="ticket_gps_fee_value" style="display:none"><?=($model->tkt_fee_val)?$model->tkt_fee_val:0?></span>
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
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading4">
                                <button id="btn_entrace" class="accordion-button collapsed flex-zm-justify" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse4"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapse4">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue">
                                        <input id="txt_entrace" name="QuoteForm[tax]" class="form-check-input fix-checkbox-margin suma_al_total"
                                               type="checkbox" <?php echo ($model->tax==1) ? 'checked' : ''; ?>>
                                        Entrace fee to Galapagos</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$
                                        <span id="entrace_value"><?=($model->tax_val)?$model->tax_val:0?></span>
                                        <span id="entrace_value_original" style="display:none"><?=($model->tax_val)?$model->tax_val:0?></span>
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
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading5">
                                <button id="btn_migration" class="accordion-button collapsed flex-zm-justify" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse5"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapse5">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue">
                                        <input id="txt_migration" name="QuoteForm[cgg]" class="form-check-input fix-checkbox-margin suma_al_total" type="checkbox"
                                        <?php echo ($model->cgg==1) ? 'checked' : ''; ?>>
                                        Migration control card</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$
                                        <span id="migration_value"><?=($model->cgg_val)?$model->cgg_val:0?></span>
                                        <span id="migration_value_original" style="display: none"><?=($model->cgg_val)?$model->cgg_val:0?></span>
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
                        <div class="flex-zm-justify border-bottom p-2 px-0">
                            <p class="fs-5 m-0 fw-bold text-price">Total Price</p>
                            <p class="fs-4 m-0 fw-bold text-price" value="<?= $model->total_cruce?>">$
                                <span id="total_price_summary"><?= $model->total_cruce?></span>*</p>
                        </div>
                    </div>
                    <p class="fs-5 text-primary m-0 title-letter mt-5"><b>B</b>Personal Information</p>
                    <form class="row g-3 py-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <select id="txt_apelativo" class="form-select" name="QuoteForm[appellative]">
                                        <option value="" selected>Select</option>
                                        <?php
                                        foreach ($prefijos as $dato)
                                        {
                                            if ($dato != 'Child'){
                                                ?>
                                                <option value="<?=$dato?>"><?=$dato?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input id="txt_nombre" type="text" class="form-control" name="QuoteForm[name]" placeholder="Name"
                                           value="<?= $model->name?>">
                                </div>
                                <div class="col-md-6">
                                    <input id="txt_telf" type="number" class="form-control" name="QuoteForm[phone]"
                                           placeholder="Phone(+5939876543210)"
                                           value="<?= $model->phone?>">
                                </div>
                                <div class="col-md-6">
                                    <input id="txt_email" type="email" class="form-control" name="QuoteForm[email]" placeholder="Email"
                                           value="<?= $model->email?>">
                                </div>
                                <div class="col-md-6">
                                    <input id="flag" hidden="hidden" class="form-control" name="flag">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="scroll-down-content"><span><i class="bi bi-chevron-down"></i>Scroll for more
                    information</span></div>
        </div>
        <div class="d-grid gap-2 fix-size-btns-footer big-size-btns-footer">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="d-grid">
                        <button id="quote" type="submit" class="btn btn-primary btn-lg" onclick="changeFlag(1)">Get a quote</button>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="d-grid">
                        <button type="submit" id="hold" class="btn btn-primary btn-lg" onclick="changeFlag(2)">24H courtesy hold</button>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="d-grid">
                        <button type="submit" id="payment" class="btn btn-primary btn-lg" onclick="changeFlag(3)">Payment</button>
                    </div>
                </div>
            </div>
            <?php
            if(is_array($model->extra_service))
            {
                ?>
                <?= Html::a('Back', ['step-land-services','model'=>$model],
                ['title'=> '','class'=>'btn btn-outline-light btn-lg border-0'])?>
                <?php
            }else{
                ?>
                <?= Html::a('Back', ['step-availability-cabins','model'=>$model],
                    ['title'=> '','class'=>'btn btn-outline-light btn-lg border-0','id'=>'btn_back'])?>
                <?php
            }
            ?>
        </div>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
             id="offcanvasStep3" aria-labelledby="offcanvasStep3Label">
            <?=$this->renderAjax('my-selection', ['model' => $model,'mostrarBotonBorrar'=>false])?>
        </div>
    </div>
    <div class="card card-testimonials">
        <p class="m-0 text-dark-blue fs-5 fw-bold text-center pt-3">Our Customers Say</p>
        <div id="carouselTestimonials" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-caption d-none d-md-block">
                        <p class="text-primary m-0 mb-3">“I took my children and it was a trip of a lifetime. The
                            natural beauty of the islands was breathtaking and my kids were thrilled to see so many
                            unique animals.”
                        </p>
                        <img src="<?= Url::to('@web/images/avatar.jpg') ?>" class="m-0" width="44" height="44" />
                        <p class="text-dark-blue fw-bold m-0 mt-2">John Doe</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <p class="text-primary m-0 mb-3">“I took my children and it was a trip of a lifetime. The
                            natural beauty of the islands was breathtaking and my kids were thrilled to see so many
                            unique animals.”
                        </p>
                        <img src="<?= Url::to('@web/images/avatar.jpg') ?>" class="m-0" width="44" height="44" />
                        <p class="text-dark-blue fw-bold m-0 mt-2">John Doe</p>
                    </div>
                </div>
            </div>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
            </div>
        </div>
    </div>
    <!--MODAL DE ITINERARIOS-->
    <div class="modal fade" id="itineraryModal" tabindex="-1" aria-labelledby="itineraryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary fs-3 fw-bold" id="itineraryModalLabel">Expedition</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <picture>
                                    <img id="map_itinerary" />
                                </picture>
                            </div>
                            <div class="col-4">
                                <div class="box-itinerary" id="text_itinerary">
                                    <h6 id="name_crucero" class="m-0 text-dark-blue fw-bold fs-5"></h6>
                                    <p id="duration"class="m-0 text-primary"></p>
                                    <p id="description" class="m-0 mt-3 text-dark-blue fw-bold"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</section>

<script>
    $(function () {
        /**P3 popup de modal para desplegar el itinerario*/
        const itineraryModal = document.getElementById('itineraryModal')
        if (itineraryModal) {
            itineraryModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const itinerary = button.getAttribute('data-bs-itinerary')
                const ship = button.getAttribute('data-bs-ship')
                getItinerary(itinerary,ship);
            })
        }
        /**P3 FIN*/

        /**P2 Suma el valor de EXTRA SERVICE al valor total, en el momneto de ingresar a la pantalla*/
        var valorExtraServ = parseFloat($('#extra_service_value').text());
        asigaPrecioTotal(1,valorExtraServ);
        /**P2 FIN*/
    });

    /**P0 Valida que al dar click en los boton tkt, control gps, entrance, sume o resten del total*/
    $("#txt_ticket_gps").click(function() {
        var nuevo_valor = 0;
        var estaActivado = false;
        estaActivado = $("#txt_ticket_gps").prop("checked");
        nuevo_valor = parseInt($("#ticket_gps_value").text());
        nuevo_valor_org = parseInt($("#ticket_gps_org_value").text());
        nuevo_valor_fee = parseInt($("#ticket_gps_fee_value").text());

        if(estaActivado)
        {
            $('#div_acordion_tkt_fee').css('display','none');
            $('#div_acordion_tkt').css('display','inline');
            $('#ticket_gps_value_modal').text(nuevo_valor_org);
            $('#ticket_gps_value').text(nuevo_valor_org);
            $('#txt_msj_no_tkt').css('display','none');
            $("#txt_ticket_gps").text(nuevo_valor_org);
            asigaPrecioTotal(true,nuevo_valor_org);
            asigaPrecioTotal(false,nuevo_valor_fee);
        }
        else
        {
            $('#div_acordion_tkt').css('display','none');
            $('#div_acordion_tkt_fee').css('display','inline');
            $('#ticket_gps_value_modal').text(nuevo_valor_fee);
            $('#ticket_gps_value').text(nuevo_valor_fee);
            $('#txt_msj_no_tkt').css('display','inline');
            $("#txt_ticket_gps").text(nuevo_valor_fee);
            asigaPrecioTotal(false,nuevo_valor_org);
            asigaPrecioTotal(true,nuevo_valor_fee);
        }
    });
    $("#txt_entrace").click(function() {
        var nuevo_valor = 0;
        var estaActivado = false;
        estaActivado = $("#txt_entrace").prop("checked");
        nuevo_valor = parseInt($("#entrace_value").text());
        valor_original = parseInt($("#entrace_value_original").text());
        asigaPrecioTotal(estaActivado,valor_original);
        if(estaActivado)
        {
            $('#div_tax_acordion_ok').css('display','inline');
            $('#entrace_value_modal').text(nuevo_valor);
            $('#txt_msj_no_fee').css('display','none');
            $("#entrace_value").text(valor_original);

        }
        else
        {
            $('#div_tax_acordion_ok').css('display','none');
            $('#entrace_value_modal').text(0);
            $('#txt_msj_no_fee').css('display','block');
            $("#entrace_value").text('0');

        }
    });
    $("#txt_migration").click(function() {
        var nuevo_valor = 0;
        var estaActivado = false;
        estaActivado = $("#txt_migration").prop("checked");
        nuevo_valor = parseInt($("#migration_value").text());
        valor_original = parseInt($("#migration_value_original").text());
        asigaPrecioTotal(estaActivado,valor_original)
        if(estaActivado)
        {
            $('#div_cgg_acordion_ok').css('display','inline');
            $('#migration_value_modal').text(nuevo_valor);
            $('#txt_msj_no_tax').css('display','none');
            $("#migration_value").text(valor_original);
        }
        else
        {
            $('#div_cgg_acordion_ok').css('display','none');
            $('#migration_value_modal').text(0);
            $('#txt_msj_no_tax').css('display','block');
            $("#migration_value").text(0);
        }
    });
    /*P0 fin  */

    /*P1 Valida que los datos de INFORMACION PERSONAL sean ingresados antes de pasar al siguiente paso*/
    $("#quote").click(function() {

        var resp = validacionDatosPersonales();
        if(resp){
            mensajeProcesando();
            return true;
        }
        else
        {
            mostarMensajeDatosPersonales();
            return false;
        }
    });
    $("#hold").click(function() {
        var resp = validacionDatosPersonales();
        if(resp){
            mensajeProcesando();
            return true;
        }
        else
        {
            mostarMensajeDatosPersonales();
            return false;
        }
    });
    $("#payment").click(function() {

        var resp = validacionDatosPersonales();
        if(resp){
            mensajeProcesando();
            return true;
        }
        else
        {
            mostarMensajeDatosPersonales();
            return false;
        }
    });
    /*P1 FIN*/

    /*P2 Suma el valor de EXTRA SERVICE al valor total, en el momneto de ingresar a la pantalla*/

    function changeFlag(numero){
        $('#flag').val(numero);
    }
    function asigaPrecioTotal(estaActivado,nuevo_valor)
    {

        var total_price = parseInt($("#total_price_summary").text());

        if(estaActivado)
        {
            total_price =total_price + nuevo_valor;
        }
        else
        {
            total_price = total_price - nuevo_valor
        }
        $("#total_price_summary").text(total_price);
        $("#total_price_modal").text(total_price);
    }
    function getItinerary(itinerary,ship)
    {
        var url = '<?= Url::to(['get-itinerary']) ?>';
        var params = {
            itinerary: itinerary,
            ship:ship,
        };
        var path='';

        $.ajax({
            data: params,
            url: url,
            type: 'POST',
            beforeSend: function() {},
            success: function(response) {
                var data = JSON.parse(response);

                if(data.path !='')
                {
                    $("#map_itinerary").attr('src', '<?= Yii::getAlias("@web")?>'+data.path)
                    $("#name_crucero").html(data.name)
                    $("#duration").html(data.duration)
                    $("#description").html(data.description)
                }
            }
        });

        return path;
    }
    function validacionDatosPersonales()
    {
        $resp = true;
        var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

        var nombre = $("#txt_nombre").val();
        var telf = $("#txt_telf").val();
        var email = $("#txt_email").val();
        var apelativo = $("#txt_apelativo").val();

        if(nombre =='' || telf == '' || email=='' || !validEmail.test(email) || apelativo=='')
        {
            $resp = false;
        }
        return $resp;
    }
    function mostarMensajeDatosPersonales()
    {
        ubicarFocusDatosPersonales();
        Swal.fire(
            'Opss!!!',
            'Please complete all the requested information.',
            'info'
        )

    }
    function  ubicarFocusDatosPersonales()
    {

        var nombre = $("#txt_nombre").val();
        var telf = $("#txt_telf").val();
        var email = $("#txt_email").val();
        var apelativo = $("#txt_apelativo").val();
        if(nombre=='')
        {
            $('#txt_nombre').focus();
            return;
        }
        var longitud = telf.length;
        if(telf=='' || longitud<10)
        {
            $('#txt_telf').focus();
            return;
        }
        if(email=='')
        {
            $('#txt_email').focus();
            return;
        }
        if(apelativo=='' || apelativo=='Select')
        {
            $('#txt_apelativo').focus();
            return;
        }

    }
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