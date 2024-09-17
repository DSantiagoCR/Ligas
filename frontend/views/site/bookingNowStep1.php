<?php
$this->title = 'Booking Now';
use yii\helpers\Url;
?>
<section class="bg-ocean">
    <div class="clouds disable-animation"></div>
    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>
    <picture class="animation-boat-step1"><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>
    <div class="container-steps">
        <h4 class="title-steps text-white">STEP 1 OF 6</h4>
        <form>
            <div class="card">
                <div class="card-body px-3">
                    <h3 class="title-form text-primary">GUESTS</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group-custom">
                                <button class="btn btn-secondary btn-lg subtract-btn">-</button>
                                <input type="number" class="form-control form-control-lg number-input" min="0" value="0"
                                    id="adultsQty">
                                <button class="btn btn-secondary btn-lg add-btn">+</button>
                            </div>
                            <label class="label-custom text-primary" for="adultsQty">Adults</label>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group-custom">
                                <button class="btn btn-secondary btn-lg subtract-btn">-</button>
                                <input type="number" class="form-control form-control-lg number-input" min="0" value="0"
                                    id="childrenQty">
                                <button class="btn btn-secondary btn-lg add-btn">+</button>
                            </div>
                            <label class="label-custom text-primary" for="childrenQty">Children <span
                                    class="text-muted">Under 12
                                    years</span></label>
                        </div>
                        <div class="col-md-12">
                            <label for="selectMonth" class="form-label text-primary">Estimated Month To Sailling</label>
                            <select class="form-select form-select-lg" id="selectMonth">
                                <option value="1">April 2023</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-primary">Cruise Duration</label>
                            <div class="row g-2 radios-custom">
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="optionsCruiseDuration" id="option1"
                                        autocomplete="off" checked>
                                    <label class="btn btn-primary btn-lg" for="option1">8 days</label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="optionsCruiseDuration" id="option2"
                                        autocomplete="off">
                                    <label class="btn btn-primary btn-lg" for="option2">5 days</label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="optionsCruiseDuration" id="option3"
                                        autocomplete="off">
                                    <label class="btn btn-primary btn-lg" for="option3">4 days</label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="optionsCruiseDuration" id="option4"
                                        autocomplete="off">
                                    <label class="btn btn-primary btn-lg" for="option4">All days</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="selectShip" class="form-label text-primary">What ship do you want?</label>
                            <select class="form-select form-select-lg" id="selectShip">
                                <option value="1">Galapagos Legend</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 fix-size-btns-footer">

                <a class="btn btn-primary btn-lg" href="<?= Yii::getAlias("@web") ?>/site/booking-now-step2/">Continue
                    and choose dates</a>
                <a class="btn btn-outline-light btn-lg border-0"
                    href="<?= Yii::getAlias("@web") ?>/site/booking-now/">Back</a>
            </div>
        </form>
    </div>
</section>
<script>
function setupComponent(subtractBtn, addBtn, numberInput) {
    subtractBtn.addEventListener('click', function(event) {
        event.preventDefault();

        if (parseInt(numberInput.value) > 0) {
            numberInput.value = parseInt(numberInput.value) - 1;
        }
    });

    addBtn.addEventListener('click', function(event) {
        event.preventDefault();

        numberInput.value = parseInt(numberInput.value) + 1;
    });
}

var inputGroups = document.querySelectorAll('.input-group-custom');

inputGroups.forEach(function(inputGroup) {
    var subtractBtn = inputGroup.querySelector('.subtract-btn');
    var addBtn = inputGroup.querySelector('.add-btn');
    var numberInput = inputGroup.querySelector('.number-input');

    setupComponent(subtractBtn, addBtn, numberInput);
});
</script>