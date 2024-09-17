<?php

use yii\helpers\Url;
$itinerary = $model->getItinerary();
if(!isset($mostrarBotonBorrar))
{
    $mostrarBotonBorrar = true;
}
$this->registerJs($this->render('/evento/jquery.blockUI.js'));
?>

<div class="offcanvas-body">
    <div class="border-bottom pb-2">
        <h3 class="title-form text-primary border-bottom pb-3">SUMMARY</h3>
        <p class="fs-4 fw-bold text-dark-blue m-0 pt-3"><?=$model->getShip()->name?></p>
        <p class="fs-5 fw-bold text-primary m-0"><?=($itinerary)?$itinerary->name:'CRUICE'?> (<?=($itinerary)?$itinerary->code:'Itinerary '.$model->itinerary?>)</p>
        <p class="text-primary m-0 pb-3 border-bottom"><?=$model->duration?> nights / <?=$model->duration + 1?> days cruise</p>
        <div class="d-grid gap-2 pt-3 pb-3 border-bottom">
            <span id="itineray_<?= $model->out_id ?>"  class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#itineraryModal"
                  data-bs-itinerary="<?= $model->itinerary ?>" data-bs-ship="<?= $model->ship_id?>">
                 <a href="#" class="">VIEW ITINERARY</a>
            </span>
            <div class="info-item-zm"> <?= strtoupper(date('D', strtotime($model->sailing_date))) ?>
                <span class="text-price fs-3 fw-bold"><?= date('j', strtotime($model->sailing_date)) ?> </span>
                <?= strtoupper(date('F, Y', strtotime($model->sailing_date))) ?>
            </div>
        </div>
        <div id="cabin-price-modal">
            <?php
            if($model->cabins)
            {
                foreach ($model->cabins as $cabin)
                {
                    ?>
                    <div id="div_modal_<?=$cabin['cabin_id'].'_'.$cabin['accommodation_id']?>">
                        <div class="flex-zm-justify mb-3 item-title-w-icon">
                            <p class="fs-4 m-0 fw-bold"><?=$cabin['cabin_name']?></p>
                            <button type="button" class="btn btn-outline-danger btn-sm close_x" aria-label="Close"
                                    <?= ($mostrarBotonBorrar)?'style="display:inline"':'style="display:none"'?>
                                    data-cabin_id="<?=$cabin['cabin_id']?>" data-acomodation1="<?=$cabin['accommodation_id']?>" data-cabin_name="<?=$cabin['cabin_name']?>"
                                    data-cabin_price="<?=$cabin['cabin_price']?>" data-det-paxs="<?=$cabin['acomodation_text']?>">
                                <i class="bi bi-x-lg"></i></button>

                        </div>
                        <div class="row g-3 mt-0">
                            <div class="col m-0 p-2">
                                <div class="info-item-zm d-block text-center">
                                    <?=$cabin['acomodation_text']?>
                                </div>
                            </div>
                            <div class="col m-0 p-2">
                                <div class="info-item-zm d-block text-center"><span
                                        class="text-price fs-3 fw-bold d-block">$<?= $cabin['cabin_price'] ?>*</span>CABIN PRICE</div>
                            </div>
                        </div>

                        <?php
                        foreach ($cabin['detalle_pax'] as $pax)
                        {
                            ?>
                            <div class="flex-zm-justify item-price-zm">
                                <p><b>Pax #<?= $pax['pax'] ?></b> (<?=$pax['type']?>)</p>
                                <p>Price <b>$<?=$pax['price']?>*</b></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div id="div_estra_services" class=""
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
                            <p>Price <b>$<span id="txt_e_s_"<?=$array['id']?> onclick="asigaPrecioTotal()"><?=$array['description']?></span>*</b></p>
                        </div>
                        <?php
                    }
                }
            }
            ?>
            <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">
              <div class="">
                 <?php
                 $suma = 0;
                 if($model->extra_service) {
                     foreach ((object)$model->extra_service as $array)
                     {
                         $suma = $suma + ($array['description']);
                     }
                 }
                 ?>
              </div>
                <div class="flex-zm-justify p-0 pb-2 pt-2" style="display:none">
                     <p class="fs-6 m-0 fw-bold text-price">Total </p>
                    <p  class="fs-4 m-0 fw-bold text-price">$
                        <span id="extra_service_value_modal" ><?=$suma?></span>*
                    </p>
                </div>
            </span>

        </div>
    </div>
    <!--    <hr>-->
    <!--    <div>-->
    <!--        <div class="flex-zm-justify item-price-zm">-->
    <!--            <span class="m-0 pt-1 pb-1 text-dark-blue">-->
    <!--              Ticket round trip-->
    <!--            </span>-->
    <!--                <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$-->
    <!--                <span id="ticket_gps_value_modal">--><?php //=($model->tkt_val)?$model->tkt_val:0?><!--</span>-->
    <!--            </span>-->
    <!--        </div>-->
    <!--        <div class="flex-zm-justify item-price-zm">-->
    <!--            <span class="m-0 pt-1 pb-1 text-dark-blue">-->
    <!--               Entrace fee to Galapagos-->
    <!--            </span>-->
    <!--                <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$-->
    <!--                <span id="entrace_value_modal">--><?php //=($model->tax_val)?$model->tax_val:0?><!--</span>-->
    <!--            </span>-->
    <!--        </div>-->
    <!--        <div class="flex-zm-justify item-price-zm">-->
    <!--           <span class="m-0 pt-1 pb-1 text-dark-blue">-->
    <!--                 Migration control card-->
    <!--            </span>-->
    <!--                <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$-->
    <!--                 <span id="migration_value_modal">--><?php //=($model->cgg_val)?$model->cgg_val:0?><!--</span>-->
    <!--            </span>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <hr>-->
    <div class="flex-zm-justify p-0 pb-2 pt-2">
        <p class="fs-5 m-0 fw-bold text-price">Estimated Price</p>
        <p  class="fs-4 m-0 fw-bold text-price">$
            <span id="total_price_modal"><?=($model->total_cruce)?$model->total_cruce:$model->cabin_total?></span>
            *</p>
    </div>

    <p id="txt_msj_average" class="m-0" style="display:none">* Average per guest.</p>
    <p id="txt_msj_no_tax" class="m-0" style="display:none">* No tax included.</p>
    <p id="txt_msj_no_tkt" class="m-0" style="display:none">* Does not include local flight ticket.</p>
    <p id="txt_msj_no_fee" class="m-0" style="display:none">* No entrance fee.</p>
    <!--    <p id="txt_msj_no_fee" class="m-0" style="display:none">* Taxes, fees and port expenses $120.00 USD.</p>-->

</div>
<div class="d-grid gap-2 p-3">
    <!--    <button class="btn btn-primary btn-lg">Change my cabins</button>-->
    <button class="btn btn-secondary btn-lg" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
</div>

<script>
    $(document).ready(function (){
        /*P1 Suma el valor de EXTRA SERVICE al valor total, en el momneto de ingresar a la pantalla*/
        var valorExtraServ1 = parseInt($('#extra_service_value_modal').text());
        asigaPrecioTotalModal(1,valorExtraServ1);
        /*P1 FIN*/

    });

    function asigaPrecioTotalModal(estaActivado,nuevo_valor)
    {
        var total_price = parseInt($("#total_price_modal").text());

        if(estaActivado) {
            total_price =total_price + nuevo_valor;
        } else {
            total_price = total_price - nuevo_valor
        }
        $("#total_price_modal").text(total_price);
    }
    $('#continue').click(function () {
        mensajeProcesando();
    })
    function mensajeProcesando()
    {
        $.blockUI({
            message: 'Processing please wait...'
        });
    }
</script>