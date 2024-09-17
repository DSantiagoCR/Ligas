<?php

$this->title = 'Booking Now';
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\form\QuoteForm;

if($model->extra_service)
{
    Yii::$app->session->set('extraServices',$model->extra_service);
}
$this->registerJs($this->render('/evento/jquery.blockUI.js'));
?>

<section class="bg-ocean">
    <div class="clouds disable-animation"></div>
    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>
    <picture class="animation-boat-step4"><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>
    <div class="container-steps width-1000">
        <div class="head-box-flex">
            <h4 class="title-steps text-white">STEP 4 OF 6 - EXTRA SERVICES</h4>
            <button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStep3"
                    aria-controls="offcanvasStep3">My Selection</button>
        </div>
        <div class="card">
            <div class="card-body pb-0">
                <div class="max-height-content-tab">
                    <p class="text-primary fs-5 fw-bold mb-2">Land Services</p>
                    <?php
                    foreach ($servicesLand as $serviceLand) {
                        ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= Yii::getAlias("@web") . "/administrator/$serviceLand->path"?>"
                                         class="img-fluid rounded-zm">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body px-3">
                                        <div class="card-body-go">
                                            <div class="flex-zm-justify pb-2">
                                                <p class="text-primary fs-4 fw-bold m-0"> <?= $serviceLand->name ?> </p>
                                                <input class="form-check-input btn_chk" value='btn_chk' id="chk_land_<?=$serviceLand->id?>" type="checkbox" value="" checked>
                                            </div>
                                            <div class="card-content-go p-0">
                                                <?php
                                                $ratePerPerson = 0;
                                                foreach ($servicesRate as $rate)
                                                {
                                                    if($rate['service_id'] == $serviceLand->id)
                                                    {
                                                        $ratePerPerson = $rate['rate'];
                                                    }
                                                }
                                                ?>
                                                <p class="mb-2"><b>From</b>
                                                    <span id="rate_land_<?= $serviceLand->id?>" >$<?= $ratePerPerson?></span> per person
                                                </p>
                                            </div>
                                            <div class="card-content-go p-0">
                                                <?= $serviceLand->description ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <p class="text-primary fs-5 fw-bold mb-2">Onboard Services</p>
                    <?php
                    foreach ($servicesOnboards as $serviceOnboards) {
                        $mostrarLand = true;
                        if($serviceOnboards->code =='KTY091') /**KTY091 = Wifi*/
                        {
                            /** Muestra el servicio de wifi segun el numero de noches*/
                            if($model->duration <5)
                            {
                                if($serviceOnboards->nights<5 )
                                {
                                    $mostrarLand = true;
                                }
                                else
                                {
                                    $mostrarLand = false;
                                }
                            }
                            else
                            {
                                if($serviceOnboards->nights>5 )
                                {
                                    $mostrarLand = true;
                                }
                                else
                                {
                                    $mostrarLand = false;
                                }
                            }
                        }
                        if($mostrarLand)
                        {

                        ?>

                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= Yii::getAlias("@web") . "/administrator/$serviceOnboards->path"?>"
                                         class="img-fluid rounded-zm">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body px-3">
                                        <div class="card-body-go">
                                            <div class="flex-zm-justify pb-2">
                                                <p class="text-primary fs-4 fw-bold m-0"> <?= $serviceOnboards->name ?> </p>
                                                <?php
                                                    $esCheched = false;
                                                    if(is_array($model->extra_service) )
                                                    {
                                                        foreach($model->extra_service as $array)
                                                        {
                                                            if($array['id']==$serviceOnboards->id)
                                                            {
                                                                $esCheched = true;
                                                            }
                                                        }
                                                    }
                                                ?>

                                                <input class="form-check-input btn_chk" value='btn_chk' id="chk_onboard_<?=$serviceOnboards->id?>"
                                                       type="checkbox" value="" <?php if($esCheched){echo('checked');}; ?>
                                                onclick="addExtraService(<?=$serviceOnboards->id?>,'<?=$serviceOnboards->code?>',
                                                    '<?=$serviceOnboards->name?>','<?=$serviceOnboards->duration?>',
                                                    '<?=$serviceOnboards->path?>')">
                                            </div>
                                            <div class="card-content-go p-0">
                                                <?php
                                                $ratePerPerson = 0;
                                                foreach ($servicesRate as $rate)
                                                {
                                                    if($rate['service_id'] == $serviceOnboards->id)
                                                    {
                                                        $ratePerPerson = $rate['rate'];
                                                    }
                                                }
                                                ?>
                                                <p class="mb-2"><b>From</b>
                                                    $<span id="rate_onboard_<?= $serviceOnboards->id?>" ><?= $ratePerPerson?></span> per person
                                                </p>
                                            </div>
                                            <div class="card-content-go p-0">
                                                <?= $serviceOnboards->description ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="scroll-down-content"><span><i class="bi bi-chevron-down"></i>Scroll for more
                    information</span></div>
        </div>
        <div class="d-grid gap-2 fix-size-btns-footer">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="d-grid">
                        <a class="btn btn-outline-secondary btn-lg"
                            <?= Html::a('Skip', ['summary','model'=>$model],
                                ['title'=> '','class'=>'btn btn-outline-secondary btn-lg','id'=>'skip'])?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-grid">
                        <?= Html::a('Continue', ['summary','model'=>$model],
                            ['title'=> '','class'=>'btn btn-primary btn-lg','id'=>'continue'])?>
                    </div>
                </div>
            </div>
            <?= Html::a('Back', ['step-availability-cabins','model'=>$model],
                ['title'=> '','class'=>'btn btn-outline-light btn-lg border-0','id'=>'btn_back'])?>
        </div>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
             id="offcanvasStep3" aria-labelledby="offcanvasStep3Label">
            <?=$this->renderAjax('my-selection', ['model' => $model,'mostrarBotonBorrar'=>false])?>
        </div>
    </div>
    <!--MODAL DE ITINERARIOS-->
    <div class="modal fade" id="itineraryModal" tabindex="-1" aria-labelledby="itineraryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary fs-3 fw-bold" id="itineraryModalLabel">Itinerary</h5>
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
</section>
<script>
    $(function () {
        //popup para mostrar el itinerario
        const itineraryModal = document.getElementById('itineraryModal')
        if (itineraryModal) {
            itineraryModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const itinerary = button.getAttribute('data-bs-itinerary')
                const ship = button.getAttribute('data-bs-ship')
                getItinerary(itinerary,ship);
            })
        }
        var estraServices = '<?=is_array($model->extra_service)?>';
        if(!estraServices)
        {
            $('.btn_chk').trigger('click');
            /* se llama a la funcion aqui, para realizar un artificio, para que model->extra_service,siempre tengra un
            * item una vez ingresado a esta pantalla,para que el trigger posterior tenga sentido*/
            addExtraService(-1, 'senuelo','no','eliminar','importante');

        }


    });

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

                $("#map_itinerary").attr('src', '<?= Yii::getAlias("@web")?>'+data.path)
                $("#name_crucero").html(data.name)
                $("#duration").html(data.duration)
                $("#description").html(data.description)

            }
        });

        return path;
    }

    function addExtraService(id, code,name,duration,path)
    {
        var estado = $('#chk_onboard_'+id).prop('checked');
        var price = $('#rate_onboard_'+id).text();
        if(!price) {
            price = '0.00';
            estado = true;
        }
                var data = {
                    id: id,
                    code: code,
                    name:name,
                    duration:duration,
                    path : path,
                    description: price,
                    status:estado,
                }
                $.ajax({
                    type: "GET",
                    url: "<?= Yii::getAlias("@web") . '/booking/add-extra-service' ?>",
                    data: data,
                    success: function (data) {
                        //Mensaje en Caso de Exito
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire(
                            'Opss!!!',
                            'There was a problem',
                            'info'
                        )
                    }
                });

    }
    function addExtraServicesModal(id, code,name,duration,path)
    {
        var html = "<div id='div_modal_"+id+"_"+code+"'>" +
            "<p class='fs-4 fw-bold text-dark-blue m-0 pt-3'>" + cabin_name + "</p>" +
            "<div class='row g-3 mt-0'>" +
            "<div class='col m-0 p-2'>" +
            "<div class='info-item-zm d-block text-center'>" + det_paxs + "</div>" +
            "</div>" +
            "<div class='col m-0 p-2'>" +
            "<div class='info-item-zm d-block text-center'><span class='text-price fs-3 fw-bold d-block'>$" + cabin_price + "*</span>CABIN PRICE</div>" +
            "</div>" +
            "</div>";

        acommodation.forEach((element) => {
            html += "<div class='flex-zm-justify item-price-zm'>" +
                "<p><b>Pax #" + element.pax + "</b> ("+element.type +")</p>" +
                "<p>Price <b>$"+ element.price + "*</b></p>" +
                "</div>";
        })

        html += "</div>";
        $('#cabin-price-modal').append(html)
    }
    $('#continue').click(function () {
        mensajeProcesando();
    })
    $('#continue').click(function () {
        mensajeProcesando();
    })
    $('#skip').click(function () {
        mensajeProcesando();
    })
    $('#btn_back').click(function () {
        mensajeProcesando();
    })
    function mensajeProcesando()
    {
        $.blockUI({
            message: 'Processing please wait...'
        });
    }
</script>