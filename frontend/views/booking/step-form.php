<?php
$this->title = 'Booking Now';

use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var QuoteForm $model */
/* @var $form kartik\widgets\ActiveForm */
/** @var $shipList */
/** @var $itineraryList */
$this->registerJs($this->render('/evento/jquery.blockUI.js'));
?>

<section class="bg-ocean">
    <?php
    $form = ActiveForm::begin([
        'id' => 'form-quote',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 0, 'deviceSize' => ActiveForm::SIZE_LARGE]
    ]);
    echo $form->field($model, 'token')->hiddenInput()->label(false)
    ?>
    <div class="clouds disable-animation"></div>
    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>"/></picture>
    <picture class="animation-boat-step1"><img src="<?= Url::to('@web/images/boat_main.png') ?>"/></picture>
    <div class="container-steps">
        <h4 class="title-steps text-white">STEP 1 OF 6</h4>
        <form>
            <div class="card">
                <div class="card-body">
                    <h3 class="title-form text-primary">GUESTS</h3>
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
                            <label class="label-custom text-primary" for="childrenQty">Children <span
                                    class="text-muted">Under 12
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
                                    <input type="radio" class="btn-check" name="optionsCruiseDuration" id="option1"
                                           autocomplete="off" value="7"  onclick="getListItinerary(8,true)"
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
                                <?php
                                echo $form->field($model, 'duration')->hiddenInput(['id' => 'duration', 'value' => ($model->duration) ? $model->duration : 7])->label(false)
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="selectShip" class="form-label text-primary">Choose a cruise ship</label>
                            <select class="form-select form-select-lg" id="selectShip" name="QuoteForm[ship_id]">
                                <option value="" >All Ships</option>
                                <?php
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
            </div>
            <div class="d-grid gap-2 fix-size-btns-footer">
                <button type="submit" class="btn btn-primary-2 btn-lg" id="continue">CONTINUE AND CHOOSE DATES</button>
                <a id="btn_back" class="btn btn-outline-light btn-lg" href="<?= Yii::getAlias("@web") ?>/booking/start/">BACK</a>
            </div>
        </form>
    </div>
    <?php ActiveForm::end(); ?>
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
            if(isNaN(parseInt(numberInput.value))){
                numberInput.value = 0;
            }else{
                numberInput.value = parseInt(numberInput.value) + 1;
            }
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
    $(function(){
        let boton = '<?= $model->duration ?>';
        if(boton == 7){
            $("#option1-lbl").removeClass('btn-secondary');
            $("#option1-lbl").addClass('btn-primary');
        }else if(boton == 4){
            $("#option2-lbl").removeClass('btn-secondary');
            $("#option2-lbl").addClass('btn-primary');
        }else if(boton == 3){
            $("#option3-lbl").removeClass('btn-secondary');
            $("#option3-lbl").addClass('btn-primary');
        }else if(boton == 1){
            $("#option4-lbl").removeClass('btn-secondary');
            $("#option4-lbl").addClass('btn-primary');
        }

        $(".field-adultsQty").removeClass('row mb-3');
        $(".field-childrenQty").removeClass('row mb-3');

        // $("#date-guests").click(function(){
        //     antiguoLeft = parseInt($('.datepicker').css("left"));
        //     $('.datepicker').css("left", antiguoLeft + 100 + "px");
        // })

        $(".btn-check").click(function(){
            $("#option1-lbl").removeClass('btn-primary').addClass('btn-secondary');
            $("#option2-lbl").removeClass('btn-primary').addClass('btn-secondary');
            $("#option3-lbl").removeClass('btn-primary').addClass('btn-secondary');
            $("#option4-lbl").removeClass('btn-primary').addClass('btn-secondary');
            $("#" + $(this).attr('id') + "-lbl").removeClass('btn-secondary');
            $("#" + $(this).attr('id') + "-lbl").addClass('btn-primary');
            $("#duration").val($(this).val());
        });
    });
    $('#continue').click(function () {
        if(!validadDatosIniciales())
        {
            mensajeProcesando();
            setTimeout(function() {
                $.unblockUI();
            }, 1500); // 5000 milisegundos = 5 segundos

        }
        else
        {
            mensajeProcesando();
        }

    })

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

    function mensajeProcesando()
    {
        $.blockUI({
            message: 'Processing please wait...'
        });
    }
    $('#btn_back').click(function () {
        mensajeProcesando();
    })
    function validadDatosIniciales()
    {
        //valida numero de pasajeros y que se selecciones una fecha
        var adt = $('#adultsQty').val();
        var chd = $('#childrenQty').val();
        var date =$('#date-guests').val();

        if(date =='' || adt=='' || chd=='' || adt <= 0 || chd < 0 )
        {
            return false;
        }
        return  true;
    }

</script>
