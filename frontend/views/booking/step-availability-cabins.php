<?php

$this->title = 'Booking Now';

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

if($model->cabins)
{
    Yii::$app->session->set('cabins',$model->cabins);
}
$this->registerJs($this->render('/evento/jquery.blockUI.js'));
$itinerary = $model->getItinerary();
?>

<section class="bg-ocean">
    <div class="clouds disable-animation"></div>
    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>
    <picture class="animation-boat-step3"><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>
    <div class="container-steps width-1000">
        <div class="head-box-flex">
            <h4 class="title-steps text-white">STEP 3 OF 6 - CABINS</h4>
            <button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStep3"
                    aria-controls="offcanvasStep3">My Selection</button>
        </div>
        <div class="card">
            <div class="card-body pb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1">Cabins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2">My Cabins Selection</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1">
                        <div class="max-height-content-tab w-padding">
                            <div class="row row-cols-1 row-cols-md-2 g-3">
                                <?php
                                if($cabins):
                                foreach ($cabins as $cabin){
                                    if ($cabin->available > 0){
                                        ?>
                                        <div class="col">
                                            <div class="card">
                                                <div id="carouselExampleIndicators_<?=$cabin->id?>" class="carousel slide"
                                                     data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <?php
                                                        $cont = 0;
                                                        foreach ($cabinImage as $imagen )
                                                        {
                                                            if($imagen['cabin']['code']==$cabin->code &&
                                                                $imagen['cabin']['ship']['code'] == $model->ship_id )
                                                            {
                                                                if($cont==0)
                                                                {

                                                                    ?>
                                                                        <button type="button" data-bs-target="#carouselExampleIndicators_<?=$cabin->id?>"
                                                                              data-bs-slide-to="<?=$cont?>" class="active" aria-current="true"
                                                                                aria-label="Slide <?=$cont?>"></button>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                        <button type="button" data-bs-target="#carouselExampleIndicators_<?=$cabin->id?>"
                                                                               data-bs-slide-to="<?=$cont?>" aria-label="Slide <?=$cont?>"></button>
                                                                    <?php
                                                                }
                                                                $cont++;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="carousel-inner">
                                                        <?php
                                                        $cont = 0;
                                                        $pathImagenPrincipal = '';
                                                        foreach ($cabinImage as $imagen )
                                                        {
                                                            if($imagen['cabin']['code']==$cabin->code &&
                                                                $imagen['cabin']['ship']['code'] == $model->ship_id )
                                                            {
                                                                if($cont==0)
                                                                {
                                                                    $cont=$cont+1;
                                                                    ?>
                                                                    <div class="carousel-item active">
                                                                        <img src="<?= Yii::getAlias("@web"). $imagen['path'] ?>"
                                                                             class="d-block" style="width:400px;height:250px"/>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <div class="carousel-item">
                                                                        <img src="<?= Yii::getAlias("@web"). $imagen['path'] ?>"
                                                                             class="d-block" style="width:400px;height:250px"/>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                if($imagen['principal']==1){
                                                                    $pathImagenPrincipal = $imagen['path'];
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="card-body-go">
                                                    <h4> <?= $cabin->name ?> </h4>
                                                    <div class="card-content-go" >
                                                        <p><b>From</b> <span> $<?= $cabin->min_gross ?> </span> per person</p>
                                                        <?php
                                                        $descripcion = \common\models\Cabin::findOne(['code' => $cabin->code]);
                                                        echo $descripcion->description;
                                                        ?>
                                                    </div>
                                                    <div class="card-footer-go row g-2">
                                                        <div class="col">
                                                            <select class="form-select" id="cabin-<?=$cabin->id?>" aria-label="Select a option">
                                                                <option value=""> Select... </option>
                                                                <?php
                                                                foreach ($cabin->type_acommodations as $type_acommodation) {
                                                                    ?>
                                                                    <optgroup label="<?=$type_acommodation->name?>">
                                                                        <?php
                                                                        foreach ($type_acommodation->acommodations as $acommodations) {
                                                                            ?>
                                                                            <option value="<?= $acommodations->id ?>"> <?= $acommodations->name ?> </option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </optgroup>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-warning" onclick="addCabin(<?= $cabin->id ?>, '<?=$cabin->name?>','<?=$cabin->available?>','<?=$cabin->code?>','<?=$pathImagenPrincipal?>')">Confirm Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <div class="max-height-content-tab w-padding">
                            <div id="cabin-price">
                                <?php
                                if($model->cabins)
                                {
                                    foreach ($model->cabins as $cabin)
                                    {
                                        ?>
                                        <div id="div_<?=$cabin['cabin_id'].'_'.$cabin['accommodation_id']?>">
                                            <div class="row g-3 border-bottom mb-3">
                                                <div class="col-12 col-md-4 m-0 p-2 pt-3 pb-3"><img
                                                        src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                                        class="d-block w-100 rounded" /></div>
                                                <div class="col-12 col-md-8 m-0 p-2 pt-3 pb-3">
                                                    <div class="flex-zm-justify mb-3 item-title-w-icon">
                                                        <p class="fs-4 m-0 fw-bold"><?=$cabin['cabin_name']?></p>
                                                        <button type="button" class="btn btn-outline-danger btn-sm close_x" aria-label="Close"
                                                                data-cabin_id="<?=$cabin['cabin_id']?>" data-acomodation1="<?=$cabin['accommodation_id']?>" data-cabin_name="<?=$cabin['cabin_name']?>"
                                                                data-cabin_price="<?=$cabin['cabin_price']?>" data-det-paxs="<?=$cabin['acomodation_text']?>">
                                                            <i class="bi bi-x-lg"></i></button>
                                                    </div>
                                                    <div class="row g-3 mt-0">
                                                        <div class="col-12 col-md-6 m-0 p-2">
                                                            <div class="info-item-zm">
                                                                <?=$cabin['acomodation_text']?>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 m-0 p-2">
                                                            <div class="info-item-zm">CABIN PRICE <span
                                                                    class="text-price fs-5 fw-bold">$<?=$cabin['cabin_price']?>*</span></div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    foreach ($cabin['detalle_pax'] as $pax)
                                                    {
                                                        ?>
                                                        <div class="flex-zm-justify item-price-zm">
                                                            <p><b>Pax #<?= $pax['pax'] ?> (</b><?=$pax['type']?>)</p>
                                                            <p>Price <b>$<?= $pax['price'] ?>*</b></p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="flex-zm-justify border-bottom total-price-m-negative">
                                <p class="fs-5 m-0 fw-bold text-price">Estimated Price</p>
                                <p id="total_price" class="fs-4 m-0 fw-bold text-price">$<?=$model->cabin_total?>*</p>
                            </div>
<!--                            <p class="fs-4 m-0 mb-2 fw-bold text-primary text-center">Upgrade option</p>-->
<!--                            <div class="upgrade-container">-->
<!--                                <div class="row g-3 align-items-center">-->
<!--                                    <div class="col-12 col-md-8">-->
<!--                                        <div class="row align-items-center">-->
<!--                                            <div class="col">-->
<!--                                                <img src="--><?php //= Url::to('@web/images/img-journey.jpg') ?><!--" class="rounded"-->
<!--                                                     width="100%" />-->
<!--                                            </div>-->
<!--                                            <div class="col-auto">-->
<!--                                                <img src="--><?php //= Url::to('@web/images/arrow-images.svg') ?><!--" />-->
<!--                                            </div>-->
<!--                                            <div class="col">-->
<!--                                                <img src="--><?php //= Url::to('@web/images/img-journey.jpg') ?><!--" class="rounded"-->
<!--                                                     width="100%" />-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-12 col-md-4">-->
<!--                                        <p class="m-0 mb-2 fw-bold text-primary">Upgrade from Junior Suite to Balcony-->
<!--                                            Suite for-->
<!--                                            1,000 USD*</p>-->
<!---->
<!--                                        <div class="card-content-go p-0">-->
<!--                                            <ul>-->
<!--                                                <li>1 cabin located in the Moon Deck-->
<!--                                                </li>-->
<!--                                                <li>Double & Triple options</li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
<!--                                        <div class="d-grid mt-2">-->
<!--                                            <button type="button" class="btn btn-warning">Select this-->
<!--                                                Upgrade</button>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-down-content"><span><i class="bi bi-chevron-down"></i>Scroll for more
                    information</span></div>
        </div>
        <div class="d-grid gap-2 fix-size-btns-footer">
            <div>
                <?php
                $form = ActiveForm::begin([
                    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'formConfig' => ['labelSpan' => 0, 'deviceSize' => ActiveForm::SIZE_LARGE]
                ]);
                echo $form->field($model, 'token')->hiddenInput()->label(false);
                echo $form->field($model, 'date_ini')->hiddenInput()->label(false);
                ?>
                <div class="d-grid" >
                    <button id="btn_book_journey" class="btn btn-primary btn-lg" type="submit">Book Your Expedition Journey</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <?= Html::a('Back', ['step-availability','model'=>$model],
                ['title'=> '','class'=>'btn btn-outline-light btn-lg border-0','id'=>'btn_back'])?>
        </div>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
             id="offcanvasStep3" aria-labelledby="offcanvasStep3Label">
            <?=$this->renderAjax('my-selection', ['model' => $model])?>
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
    var total_paxs = 0

    $(function () {        //popup

        const itineraryModal = document.getElementById('itineraryModal')
        if (itineraryModal) {
            itineraryModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const itinerary = button.getAttribute('data-bs-itinerary')
                const ship = button.getAttribute('data-bs-ship')
                getItinerary(itinerary,ship);
            })
        }
    });
    $(document).ready(function() {

        if (!"<?= empty($model->cabins) ?>"){
            total_paxs = "<?=$model->adt + $model->chd?>"
        }

        /** Elimina las cabinas selecionadas*/
        $(document).on('click', 'button.close_x', function() {
            var cabin_id = $(this).data('cabin_id');
            var acomodation_id = $(this).data('acomodation1');
            var cabin_name = $(this).data('cabin_name');
            var cabin_price = $(this).data('cabin_price');
            var det_paxs = $(this).data('detPaxs');

            /** Elimino el Div*/
            deleteCabinsSelection(cabin_name, cabin_price,  cabin_id,acomodation_id, det_paxs);
            var div_name = "div_"+cabin_id+"_"+acomodation_id;
            var div_id_modal = "div_modal_"+cabin_id+"_"+acomodation_id;
            $('#'+div_name).remove();
            $('#'+div_id_modal).remove();
        });

    });

    $("#btn_book_journey").click(function(event) {
        if(total_paxs>0)
        {
            mensajeProcesando();
            return true;
        }
        else
        {
            Swal.fire(
                'Opss!!!',
                'In order to continue, you must select at least one cabin.',
                'info'
            )
            return  false;

        }
    });

    function addCabin(cabin_id, cabin_name,available,code,pathImagenPrincipal)
    {
        mensajeProcesando();
        var acomodation = $('#cabin-'+ cabin_id + ' option:selected').val();
        var acomodation_text = $('#cabin-'+ cabin_id + ' option:selected').text();
        var new_paxs = acomodation_text.split('/')
        var cabin_total_paxs = (new_paxs[1]) ? (parseInt(new_paxs[0].replace(/[^0-9]+/g, "")) + parseInt(new_paxs[1].replace(/[^0-9]+/g, "")))  : new_paxs[0].replace(/[^0-9]+/g, "")
        var sum = parseInt(cabin_total_paxs) + parseInt(total_paxs);

        if (Number.isInteger(sum)){
            if (parseInt(sum) < 10){
                total_paxs = sum;
                var data = {
                    cabin_id: cabin_id,
                    accommodation_id: acomodation,
                    acomodation_text:acomodation_text,
                    cabin_name:cabin_name,
                    token : "<?=$model->token?>",
                    id: "<?=$model->out_id?>",
                    ship_id : "<?=$model->ship_id?>",
                    duration: "<?=$model->duration?>",
                    available:available,
                    code:code,
                }
                $.ajax({
                    type: "GET",
                    url: "<?= Yii::getAlias("@web") . '/booking/get-cabins-price' ?>",
                    data: data,
                    success: function (data) {
                        if(Math.floor(data.price)>0)
                        {
                            addCabinsSelection(cabin_name, data.price, data.detalle_pax, acomodation_text,cabin_id,acomodation,pathImagenPrincipal);
                            addCabinsSelectionModal(cabin_name, data.price, data.detalle_pax, acomodation_text,cabin_id,acomodation,pathImagenPrincipal);
                            var total = parseInt($('#total_price').text().replace(/[^0-9]+/g, ""));
                            $('#total_price').text('$'+(total + data.price)+'*')
                            $('#total_price_modal').text((total + data.price))
                            pupUpContinueNextPage();

                        }
                        else
                        {
                            total_paxs = total_paxs - parseInt(cabin_total_paxs);
                            Swal.fire(
                                'Opss!!!',
                                'You can no longer add cabins of this type',
                                'info'
                            )
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire(
                            'Opss!!!',
                            'Choose an accommodation',
                            'info'
                        )
                    }
                });
            } else {
                Swal.fire(
                    'Opss!!!',
                    'You have exceeded the maximum number of passengers <b>(Max 9 passengers)</b>, it is not possible to add more cabins with that accommodation',
                    'info'
                )
            }
        } else {
            Swal.fire(
                'Opss!!!',
                'Choose an accommodation',
                'info'
            )
        }
        $.unblockUI();
    }

    function addCabinsSelection(cabin_name, cabin_price, acommodation, det_paxs,cabin_id,acomodation1,pathImagenPrincipal)
    {
        var html = "<div id='div_"+cabin_id+"_"+acomodation1+"'>" +
            "<div class='row g-3 border-bottom mb-3'>" +
            "<div class='col-12 col-md-4 m-0 p-2 pt-3 pb-3'>" +
            "<img src='<?= Yii::getAlias('@web')?>"+pathImagenPrincipal+"' class='d-block w-100 rounded' />" +
            "</div>" +
            "<div class='col-12 col-md-8 m-0 p-2 pt-3 pb-3'>" +
            "<div class='flex-zm-justify mb-3 item-title-w-icon'>" +
            "<p class='fs-4 m-0 fw-bold'>" + cabin_name + "</p>" +
            "<button type='button' class='btn btn-outline-danger btn-sm close_x' aria-label='Close' " +
            "data-cabin_id="+cabin_id+" data-acomodation1="+acomodation1+" data-cabin_name="+cabin_name+" "+
            "data-cabin_price="+cabin_price+" data-det-paxs='"+det_paxs+"'>"+
            "<i class='bi bi-x-lg'></i>" +
            "</button>" +
            "</div>" +
            "<div class='row g-3 mt-0'>" +
            "<div class='col-12 col-md-6 m-0 p-2'>" +
            "<div class='info-item-zm'>" + det_paxs + "</div>" +
            "</div>" +
            "<div class='col-12 col-md-6 m-0 p-2'>" +
            "<div class='info-item-zm'>CABIN PRICE <span class='text-price fs-5 fw-bold'>$" + cabin_price + "*</span></div>" +
            "</div>" +
            "</div>"

        acommodation.forEach((element) => {
            html += "<div class='flex-zm-justify item-price-zm'>" +
                "<p><b>Pax #" + element.pax + "</b> ("+element.type +")</p>" +
                "<p>Price <b>$" + element.price + "*</b></p>" +
                "</div>"
        })

        html += "</div>" +
            "</div>"+
            "</div>"

        $('#cabin-price').append(html)
    }

    function addCabinsSelectionModal(cabin_name, cabin_price, acommodation, det_paxs, cabin_id, acomodation1,pathImagenPrincipal)
    {
        var html = "<div id='div_modal_"+cabin_id+"_"+acomodation1+"'>" +
            "<div class='flex-zm-justify mb-3 item-title-w-icon'>" +
            "<p class='fs-4 fw-bold text-dark-blue m-0 pt-3'>" + cabin_name + "</p>" +
            "<button type='button' class='btn btn-outline-danger btn-sm close_x' aria-label='Close' " +
            "data-cabin_id="+cabin_id+" data-acomodation1="+acomodation1+" data-cabin_name="+cabin_name+" "+
            "data-cabin_price="+cabin_price+" data-det-paxs='"+det_paxs+"'>"+
            "<i class='bi bi-x-lg'></i>" +
            "</button>" +
            "</div>"+
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

    function deleteCabinsSelection(cabin_name, cabin_price,  cabin_id,acomodation_id, det_paxs)
    {
        var data = {
            cabin_id: cabin_id,
            accommodation_id: acomodation_id,
            cabin_name:cabin_name,
            cabin_price : cabin_price,
        }

        var new_paxs = det_paxs.split('/')
        var cabin_total_paxs = (new_paxs[1]) ? (parseInt(new_paxs[0].replace(/[^0-9]+/g, "")) + parseInt(new_paxs[1].replace(/[^0-9]+/g, "")))  : new_paxs[0].replace(/[^0-9]+/g, "")
        total_paxs = parseInt(total_paxs) - parseInt(cabin_total_paxs);

        $.ajax({
            type: "GET",
            url: "<?= Yii::getAlias("@web") . '/booking/delete-cabins-selected' ?>",
            data: data,
            success: function (data) {
                var total = parseInt($('#total_price').text().replace(/[^0-9]+/g, ""));
                $('#total_price').text('$'+(total - cabin_price)+'*')
                $('#total_price_modal').text( (total - cabin_price) )
            },
        });

    }
    // function ejecutaGif()
    // {
    //     Swal.fire({
    //         title: 'Check My Cabins Selection',
    //         text: 'Confirmation OK',
    //         icon: 'success',
    //         timer: 2500, // 500 ms = medio segundo
    //         showConfirmButton: false
    //     });
    //
    // }
    function pupUpContinueNextPage()
    {
        Swal.fire({
            title: 'Do you want to continue?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#F3C809',
            cancelButtonColor: '#76BCBF',
            confirmButtonText: 'YES',
            cancelButtonText:'NO'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#btn_book_journey").trigger('click');
            }
        })
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

                $("#map_itinerary").attr('src', '<?= Yii::getAlias("@web")?>'+data.path)
                $("#name_crucero").html(data.name)
                $("#duration").html(data.duration)
                $("#description").html(data.description)

            }
        });

        return path;
    }
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