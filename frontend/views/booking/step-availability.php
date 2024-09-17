<?php
$this->title = 'Booking Now';

use kartik\date\DatePicker;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var QuoteForm $model * */
/** @var $shipList * */
/** @var $itineraryList * */
/** @var $availability * */

$this->registerJs($this->render('/evento/jquery.blockUI.js'));
$contOutPutCorales = -1;
$contCloseCorales = 0;
$contOutPutLg = -1;
$contCloseLg = 0;
?>
<input id="path_image" type="hidden"/>
<section class="bg-ocean">
    <div class="clouds disable-animation"></div>

    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>"/></picture>

    <picture class="animation-boat-step2"><img src="<?= Url::to('@web/images/boat_main.png') ?>"/></picture>

    <div class="container-steps width-1000">
        <div class="head-box-flex">
            <h4 class="title-steps text-white">STEP 2 OF 6 - DATES</h4>
            <button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStep2"
                    aria-controls="offcanvasStep2">My Selection
            </button>
        </div>

        <div class="card">
            <div class="card-body pb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1">All Ships</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1">
                        <div class="max-height-content-tab pb-4">
                            <?php
                            if ($availability) {
                                foreach ($availability as $duration) {
                                    foreach ($duration as $ship) {
                                        foreach ($ship as $output) {
                                            ?>
                                            <div class="title-tab-w-button  mt-3">
                                                <h5 class="text-primary fw-bold">
                                                    <?= /*$output[0]->ship->name.' '.$output[0]->ship->id*/'' ?>&nbsp;
                                                    <?= $output[0]->ship->name?>&nbsp;
                                                    <span
                                                            class="fw-normal fw-bold"> / <?= $output[0]->code ?> Expeditions
                                                    </span>
                                                </h5>
                                            </div>
                                            <div class="row-day-cards">
                                                <?php
                                                if('BAR000'==ltrim(rtrim($output[0]->ship->id))) {
                                                    $contOutPutCorales = count($output);
                                                    $contCloseCorales = 0;
                                                    foreach ($output as $out) {
                                                        if ($out->status == 'Close') {
                                                            $contCloseCorales++;
                                                        }
                                                    }
                                                }
                                                if('BAR003'==ltrim(rtrim($output[0]->ship->id))) {
                                                    $contOutPutLg= count($output);
                                                    $contCloseLg = 0;
                                                    foreach ($output as $out) {
                                                        if ($out->status == 'Close') {
                                                            $contCloseLg++;
                                                        }
                                                    }
                                                }
                                                foreach ($output as $out) {
                                                    $promotion = $plane = $text_promotion = '';
                                                    $price = $price_promo = $out->min_gross;
                                                    $status = ($out->status == 'Close') ? 'disabled-day-card soldout-day-card' : '';
                                                    if (is_object($out->promotion)) {
                                                        if ($out->promotion->code == 'TKT Free' && $out->status != 'Close') {
                                                            $plane = 'block';
                                                        }
                                                        $promotion = 'featured-day-card';
                                                    }
                                                    if (is_array($out->promotions_cabin)) {
                                                        $bandera = '';
                                                        foreach ($out->cabins as $cabin) {
                                                            if ($cabin->disponible > 0 && is_object($cabin->promocion)) {
                                                                $bandera = $cabin->codigo;
                                                                break;
                                                            }
                                                        }
                                                        foreach ($out->promotions_cabin as $item) {
                                                            if ($item->cabin == $bandera) {
                                                                $promotion = 'featured-day-card';
                                                                $price = $item->gross;
                                                                $price_promo = $item->promo;
                                                                break;
                                                            }
                                                        }
                                                        $text_promotion = (count($out->promotions_cabin) > 0 && !$plane) ? 'text-decoration-line-through' : '';
                                                    }
                                                    ?>
                                                    <div>
                                                        <?php
                                                        $yearCruice = date('Y', strtotime($out->start_date));

                                                        $modelYear = \common\models\Years::find()
                                                            ->where(['name'=>$yearCruice])
                                                            ->where(['status'=>true])
                                                            ->one();

                                                        $modelShip = \common\models\Ship::find()
                                                            ->where(['status'=>true])
                                                            ->andWhere(['code'=>ltrim(rtrim($out->ship->id))])
                                                            ->one();

                                                        $modelItinerary = \common\models\Itinerary::find()
                                                        ->where(['ship_id'=>$modelShip->id])
                                                        ->andWhere(['code'=>ltrim(rtrim($out->combination_itinerary))])
                                                        ->andWhere(['status'=>true])
                                                        ->andWhere(['year_id'=>$modelYear->id])
                                                        ->one();


                                                        ?>
                                                        <p class="label-extra-itinerary" style="color: <?= $out->itinerary->color ?>; cursor: help">
                                                                <span id="itineray_<?= $out->id ?>"  class="itineray_view" data-bs-toggle="modal" data-bs-target="#itineraryModal"
                                                                      data-bs-itinerary="<?= $out->combination_itinerary ?>" data-bs-ship="<?= $out->ship->id ?>">
                                                                    <i class="fas fa-eye"></i> <?=($modelItinerary)?$modelItinerary->name:$out->combination_itinerary ?>
                                                                </span>
                                                        </p>
                                                        <div id="<?= $out->id ?>" data-duration="<?=$out->nights?>" data-start-Date="<?=$out->start_date?>"
                                                             data-ship-code="<?=$output[0]->ship->id?>"
                                                             data-bs-itinerary="<?= $out->combination_itinerary ?>" data-end-date="<?=$out->end_date?>"
                                                             class="container-day-card <?= $promotion ?> <?= $status ?> ">
                                                            <div class="day-card text-center">
                                                                <p class="text-uppercase"><?= date('D', strtotime($out->start_date)) ?></p>
                                                                <p class="fs-2"><?= date('d', strtotime($out->start_date)) ?></p>
                                                                <p class="text-month"><?= strtoupper(date('M Y', strtotime($out->start_date))) ?></p>
                                                                <p class="text-from fw-bold">FROM</p>
                                                                <p class="text-price fs-5 fw-bold <?= $text_promotion ?> ">
                                                                    $<?= $price ?>*
                                                                </p>
                                                            </div>
                                                            <p id="select_<?= $out->id ?>_<?= $out->nights ?>" style="display: none"
                                                               class="label-extra">SELECTED</p>
                                                            <?php
                                                            if ($text_promotion) {
                                                                ?>
                                                                <div class="content-featured">NOW
                                                                    $<?= $price_promo ?></div>
                                                                <?php
                                                            }
                                                            if ($status) {
                                                                ?>
                                                                <p class="label-extra-sold">SOLD OUT</p>
                                                                <?php
                                                            }
                                                            if ($plane) {
                                                                ?>
                                                                <div class="content-featured">
                                                                    <i class="fas fa-plane"></i>SAVE $450
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="separator-line"></div>
                                            <?php
                                        }

//                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class=" tab-pane fade" id="tab2">
                        <p>Contenido del Tab 2</p>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <p>Contenido del Tab 3</p>
                    </div>
                </div>
            </div>
            <div class="scroll-down-content">
                <span><i class="bi bi-chevron-down"></i>Scroll for more information</span>
            </div>
        </div>

        <!--FORMULARIO DE CONSULTA CABINAS-->
        <div class="d-grid gap-2 fix-size-btns-footer">
            <div>
                <?php
                $form = ActiveForm::begin([
                    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'formConfig' => ['labelSpan' => 0, 'deviceSize' => ActiveForm::SIZE_LARGE]
                ]);

                echo $form->field($model, 'token')->hiddenInput()->label(false);
                echo $form->field($model, 'ship_id')->hiddenInput()->label(false);
                ?>
                <div class="offcanvas-body">
                    <input hidden="hidden" id="out_id" name="QuoteForm[out_id]">
                    <input hidden="hidden" id="duration_cabins" name="QuoteForm[duration]">
                    <input hidden="hidden" id="start_date" name="QuoteForm[sailing_date]">
                    <input hidden="hidden" id="end_date" name="QuoteForm[sailing_end_date]">
                    <input hidden="hidden" id="itinerary" name="QuoteForm[itinerary]">
                </div>
                <div class="d-grid gap-2 p-3" >
                    <button id="continue" class="btn btn-primary btn-lg" type="submit">Continue and choose your cabins</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <?= Html::a('Back', ['step-form','model'=>$model],
                ['title'=> '','class'=>'btn btn-outline-light btn-lg border-0','id'=>'btn_back'])?>
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

    <!--FORMULARIO DE CONSULTA-->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
         id="offcanvasStep2" aria-labelledby="offcanvasStep2Label">
        <?php
        $form = ActiveForm::begin([
            'id' => 'form-quote',
            'action' => ['step-form'],
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 0, 'deviceSize' => ActiveForm::SIZE_LARGE]
        ]);
        echo $form->field($model, 'token')->hiddenInput()->label(false)
        ?>
        <div class="offcanvas-body">
            <h3 class="title-form text-primary">YOUR SELECTION</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="input-group-custom">
                        <button class="btn btn-secondary btn-lg subtract-btn">-</button>
                        <?=
                        $form->field($model, 'adt', [
                            "template" => "{input}\n{hint}\n{error}"
                        ])->textInput([
                            "class" => "form-control form-control-lg number-input",
                            "id" => "adultsQty"
                        ])
                        ?>
                        <button class="btn btn-secondary btn-lg add-btn">+</button>
                    </div>
                    <label class="label-custom text-primary" for="adultsQty">Adults</label>
                </div>
                <div class="col-md-6">
                    <div class="input-group-custom">
                        <button class="btn btn-secondary btn-lg subtract-btn">-</button>
                        <?=
                        $form->field($model, 'chd', [
                            "template" => "{input}\n{hint}\n{error}"
                        ])->textInput([
                            "class" => "form-control form-control-lg number-input",
                            "id" => "childrenQty"
                        ])
                        ?>
                        <button class="btn btn-secondary btn-lg add-btn">+</button>
                    </div>
                    <label class="label-custom text-primary" for="childrenQty">Children <span>Under 12
                                years</span></label>
                </div>
                <div class="col-md-12">
                    <label for="selectMonth" class="form-label text-primary">When would you like to travel?</label>
                    <?php
                    echo $form->field($model, 'date', ['template' => '{input}'])
                        ->widget(DatePicker::classname(), [
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'options' => ['placeholder' => 'mm-yyyy', 'id' => 'date-guests', 'class' => 'text-center'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'M-yyyy',
                                'minViewMode' => "months",
                                'orientation' => 'bottom auto',
                                'startDate' => date('Y-m-d'),
                            ]
                        ])->label(false);
                    ?>
                </div>
                <div class="col-md-12">
                    <label class="form-label text-primary">Cruise Length</label>
                    <div class="row g-2 radios-custom">
                        <div class="col">
                            <input type="radio" class="btn-check" name="optionsCruiseDuration"  id="option1"
                                   autocomplete="off" value="7" checked onclick="getListItinerary(8,true)"
                                <?= ($model->duration==7)?'checked':''?>
                            >
                            <label class="btn btn-secondary btn-lg" for="option1" id="option1-lbl">8 days</label>
                        </div>
                        <div class="col">
                            <input type="radio" class="btn-check" name="optionsCruiseDuration" id="option2"
                                   autocomplete="off" value="4" onclick="getListItinerary(5,true)"
                                <?= ($model->duration==4)?'checked':''?>
                            >
                            <label class="btn btn-secondary btn-lg" for="option2" id="option2-lbl">5 days</label>
                        </div>
                        <div class="col">
                            <input type="radio" class="btn-check" name="optionsCruiseDuration" id="option3"
                                   autocomplete="off" value="3" onclick="getListItinerary(4,true)"
                                <?= ($model->duration==3)?'checked':''?>
                            >
                            <label class="btn btn-secondary btn-lg" for="option3" id="option3-lbl">4 days</label>
                        </div>
                        <div class="col">
                            <input type="radio" class="btn-check" name="optionsCruiseDuration" id="option4"
                                   autocomplete="off" value="1" onclick="getListItinerary(0,false)"
                                <?= ($model->duration==1)?'checked':''?>
                            >
                            <label class="btn btn-secondary btn-lg" for="option4" id="option4-lbl">All days</label>
                        </div>
                        <div>
                            <input type="hidden" id="quoteform-duration" name="" value="">
                        </div>

                        <?php
                        echo $form->field($model, 'duration')->hiddenInput()->label(false)
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="selectShip" class="form-label text-primary">Choose a cruise ship</label>
                    <select class="form-select form-select-lg" id="selectShip" name="QuoteForm[ship_id]">
                        <option value="">All Ships</option>
                        <?php
                        $selected = '';
                        foreach ($shipList as $list) {
                            $selected = ($list->code == $model->ship_id) ? 'selected' : '';
                            echo "<option $selected value='$list->code'>$list->name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="selectItinerary" class="form-label text-primary">Choose your Expedition Journey</label>
                    <select class="form-select form-select-lg" id="selectItinerary" name="QuoteForm[itinerary]">
                        <option value="" >All Expeditions</option>
                        <?php
                        foreach ($itineraryList as $list) {
                            $selected = ($list->code == $model->itinerary) ? 'selected' : '';
                            echo "<option $selected value='$list->code'>$list->name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 p-3" >
            <button class="btn btn-primary btn-lg" type="submit" id="btn_update">Update</button>
            <button class="btn btn-secondary btn-lg" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                Close
            </button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</section>
<script>
    function setupComponent(subtractBtn, addBtn, numberInput) {
        subtractBtn.addEventListener('click', function (event) {
            event.preventDefault();

            if (parseInt(numberInput.value) > 0) {
                numberInput.value = parseInt(numberInput.value) - 1;
            }
        });

        addBtn.addEventListener('click', function (event) {
            event.preventDefault();

            numberInput.value = parseInt(numberInput.value) + 1;
        });
    }

    var inputGroups = document.querySelectorAll('.input-group-custom');

    inputGroups.forEach(function (inputGroup) {
        var subtractBtn = inputGroup.querySelector('.subtract-btn');
        var addBtn = inputGroup.querySelector('.add-btn');
        var numberInput = inputGroup.querySelector('.number-input');

        setupComponent(subtractBtn, addBtn, numberInput);
    });
</script>
<script>
    $(function () {

        $('#continue').click(function () {
            if (!$('.selected-day-card').length > 0){
                Swal.fire(
                    'Opss!!!',
                    'Select one date to continue.',
                    'info'
                )
                return false;
            }
            mensajeProcesando();

        })

        let boton = '<?= $model->duration ?>';
        if (boton == 7) {
            $("#option1-lbl").removeClass('btn-secondary');
            $("#option1-lbl").addClass('btn-primary');
        } else if (boton == 4) {
            $("#option2-lbl").removeClass('btn-secondary');
            $("#option2-lbl").addClass('btn-primary');
        } else if (boton == 3) {
            $("#option3-lbl").removeClass('btn-secondary');
            $("#option3-lbl").addClass('btn-primary');
        } else if (boton == 1) {
            $("#option4-lbl").removeClass('btn-secondary');
            $("#option4-lbl").addClass('btn-primary');
        }

        $(".btn-check").click(function () {
            $("#option1-lbl").removeClass('btn-primary').addClass('btn-secondary');
            $("#option2-lbl").removeClass('btn-primary').addClass('btn-secondary');
            $("#option3-lbl").removeClass('btn-primary').addClass('btn-secondary');
            $("#option4-lbl").removeClass('btn-primary').addClass('btn-secondary');
            $("#" + $(this).attr('id') + "-lbl").removeClass('btn-secondary');
            $("#" + $(this).attr('id') + "-lbl").addClass('btn-primary');
            $("#duration").val($(this).val());
        });

        $(".field-adultsQty").removeClass('row mb-3');
        $(".field-childrenQty").removeClass('row mb-3');

        //acciones de disponibilidad
        $(".container-day-card").click(function () {
            let id = $(this).attr('id');
            let duration = $(this).attr('data-duration');
            let start_date = $(this).attr('data-start-date');
            let end_date = $(this).attr('data-end-date');
            let itinerary = $(this).attr('data-bs-itinerary');
            let ship_code = $(this).attr('data-ship-code');


            $('#out_id').val(id)
            $('#duration_cabins').val(duration)
            $('#start_date').val(start_date)
            $('#end_date').val(end_date)
            $('#itinerary').val(itinerary)
            $('#quoteform-ship_id').val(ship_code)

            $(".label-extra").hide();
            $("#select_" + id+"_"+duration).show();
            $('div').removeClass('selected-day-card');
            $(this).addClass('selected-day-card');

            setTimeout(function (){
                    pupUpContinueNextPage();
                },
                350   //1000 milisegundos = 1 segundo
            );

        });

        //popup
        const itineraryModal = document.getElementById('itineraryModal')
        if (itineraryModal) {
            itineraryModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const itinerary = button.getAttribute('data-bs-itinerary')
                const ship = button.getAttribute('data-bs-ship')
                getItinerary(itinerary,ship);
            })
        }

        $('input[name="optionsCruiseDuration"]').click(function() {
            var value = $(this).val();
            $("#quoteform-durations").val(value);
        });
        /** Muestra un Mensaje si tadas la salida estan Cerradas*/
        mensajeSalidasCerradas();

    });

    function getItinerary(itinerary,ship)
    {
        $("#map_itinerary").empty();
        $("#map_itinerary").attr('src', '');
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
    function getListItinerary(dias,esDias)
    {
        var url = '<?= Url::to(['get-list-itinerary']) ?>';
        var params = {
            dias: dias,
            esDias : esDias,
        };

        $.ajax({
            data: params,
            url: url,
            type: 'POST',
            success: function(response) {
                $('#selectItinerary').empty();
                var data = JSON.parse(response);
                $('#selectItinerary').append($('<option>', {
                    value: '',
                    text: 'All Expeditions',
                }));
                $.each(data, function(index, item) {
                    $('#selectItinerary').append($('<option>', {
                        value: index,
                        text: item,
                    }));
                });

            }
        });
    }
    $('#btn_update').click(function () {
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
    function mensajeSalidasCerradas()
    {
        var estanSalidasTodasCerradasLg = false;
        var estanSalidasTodasCerradasCorales = false;
        var contOutPutCorales = '<?=$contOutPutCorales?>';
        var contCloseCorales = '<?=$contCloseCorales?>';
        var contOutPutLg = '<?=$contOutPutLg?>';
        var contCloseLg = '<?=$contCloseLg?>';


        if(contOutPutCorales == contCloseCorales)
        {
            estanSalidasTodasCerradasLg = true;
        }
        if(contOutPutLg == contCloseLg)
        {
            estanSalidasTodasCerradasCorales = true
        }
        textoMensajesSalidasCerradas(estanSalidasTodasCerradasLg,estanSalidasTodasCerradasCorales,contOutPutCorales,contOutPutLg);
        textoMensajesNoHaySalidas(contOutPutCorales,contOutPutLg,contOutPutCorales,contOutPutLg);

    }
    function textoMensajesSalidasCerradas(estanSalidasTodasCerradasLg,estanSalidasTodasCerradasCorales,contOutPutCorales,contOutPutLg)
    {
        if(estanSalidasTodasCerradasLg==true && estanSalidasTodasCerradasCorales==true)
        {
            popupMensajeSalidaCerrada('All Cruises on the selected date are closed');
        }else
        {
            if(estanSalidasTodasCerradasCorales==false && estanSalidasTodasCerradasLg==false)
            {

            }
            else
            {
                if(estanSalidasTodasCerradasCorales==true && estanSalidasTodasCerradasLg==true)
                {
                    popupMensajeSalidaCerrada('All Cruises on the selected date are closed');
                }
            }

        }
    }
    function popupMensajeSalidaCerrada(texto)
    {
        Swal.fire({
            title: texto,
            text: 'Please do a click in Back and select a new date.',
            icon: 'info',
            //timer: 2000, // 500 ms = medio segundo
            // showConfirmButton: false
        });
    }
    function textoMensajesNoHaySalidas(contOutPutCorales,contOutPutLg)
    {
        if(contOutPutCorales==-1 && contOutPutLg ==-1)
        {
            Swal.fire({
                title: 'Opss!!!, There are not cruise in the chosen dates.',
                text: 'Please do a click in Back and select a new date.',
                confirmButtonText: 'BACK',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#btn_back')[0].click();
                }
            })
        }
    }
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
                $("#continue").trigger('click');
            }
        })
    }
</script>