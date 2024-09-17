<?php
$this->title = 'Booking Now';
use yii\helpers\Url;
?>
<section class="bg-ocean">
    <div class="clouds disable-animation"></div>

    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>

    <picture class="animation-boat-step2"><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>

    <div class="container-steps width-1000">
        <div class="head-box-flex">
            <h4 class="title-steps text-white">STEP 2 OF 6 - DATES</h4>
            <button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStep2"
                aria-controls="offcanvasStep2">My Selection</button>
        </div>

        <div class="card">
            <div class="card-body pb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1">All Ships</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2">Galapagos Legend</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3">Coral Yatchs</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1">
                        <div class="max-height-content-tab pb-4">
                            <div class="title-tab-w-button  mt-3">
                                <h5 class="text-primary fw-bold">Galapagos Cruise North Central <span
                                        class="fw-normal">(4
                                        days - 3
                                        nights)</span>
                                </h5>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#itineraryModal">View Itinerary</button>
                            </div>
                            <div class="row-day-cards">
                                <div>
                                    <div class="container-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">THU</p>
                                            <p class="fs-2">2</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold">$2.610*</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container-day-card featured-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">MON</p>
                                            <p class="fs-2">6</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold">$2.420*</p>
                                        </div>
                                        <div class="content-featured"><i class="bi bi-airplane"></i>SAVE $450
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container-day-card featured-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">THU</p>
                                            <p class="fs-2">9</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold text-decoration-line-through">$2.134*
                                            </p>
                                        </div>
                                        <div class="content-featured">NOW $1.999</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container-day-card featured-day-card selected-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">MON</p>
                                            <p class="fs-2">6</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold">$2.420*</p>
                                        </div>
                                        <p class="label-extra">SELECTED</p>
                                        <div class="content-featured"><i class="bi bi-airplane"></i>SAVE $450
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container-day-card disabled-day-card soldout-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">THU</p>
                                            <p class="fs-2">2</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold">$2.610*</p>
                                        </div>
                                        <p class="label-extra">SOLD OUT</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="container-day-card disabled-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">THU</p>
                                            <p class="fs-2">2</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold">$2.610*</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="extend-content mt-4">
                                <h5 class="text-primary fw-bold">Extend your expedition one day more for 500 USD*</h5>
                                <div class="row-day-cards">
                                    <div>
                                        <div class="container-day-card">
                                            <div class="day-card text-center">
                                                <p class="text-uppercase">THU</p>
                                                <p class="fs-2">2</p>
                                                <p class="text-month">APRIL 2023</p>
                                                <p class="text-from fw-bold">FROM</p>
                                                <p class="text-price fs-5 fw-bold">$2.610*</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="container-day-card featured-day-card">
                                            <div class="day-card text-center">
                                                <p class="text-uppercase">MON</p>
                                                <p class="fs-2">6</p>
                                                <p class="text-month">APRIL 2023</p>
                                                <p class="text-from fw-bold">FROM</p>
                                                <p class="text-price fs-5 fw-bold">$2.420*</p>
                                            </div>
                                            <div class="content-featured"><i class="bi bi-airplane"></i>SAVE $450
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center text-muted m-0 mt-3">* Average price per guest.</p>
                            <p class="text-center text-muted m-0 mt-1">* Local flight ticket $450 USD (Free).</p>
                            <p class="text-center text-muted m-0 mt-1">* Taxes, fees and port expenses $120.00 USD (Not
                                included).</p>
                            <div class="separator-line"></div>
                            <div class="title-tab-w-button">
                                <h5 class="text-primary fw-bold">Galapagos Cruise West <span class="fw-normal">(4
                                        days - 3
                                        nights)</span>
                                </h5>
                                <button type="button" class="btn btn-outline-primary">View Itinerary</button>
                            </div>
                            <div class="row-day-cards">
                                <div>
                                    <div class="container-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">THU</p>
                                            <p class="fs-2">2</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold">$2.610*</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">MON</p>
                                            <p class="fs-2">6</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold">$2.420*</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container-day-card">
                                        <div class="day-card text-center">
                                            <p class="text-uppercase">THU</p>
                                            <p class="fs-2">13</p>
                                            <p class="text-month">APRIL 2023</p>
                                            <p class="text-from fw-bold">FROM</p>
                                            <p class="text-price fs-5 fw-bold">$2.120*</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            <div class="scroll-down-content"><span><i class="bi bi-chevron-down"></i>Scroll for more
                    information</span></div>
        </div>
        <div class="d-grid gap-2 fix-size-btns-footer">
            <a class="btn btn-primary btn-lg" href="<?= Yii::getAlias("@web") ?>/site/booking-now-step3/">Continue and
                choose your cabins</a>
            <a class="btn btn-outline-light btn-lg border-0"
                href="<?= Yii::getAlias("@web") ?>/site/booking-now-step1/">Back</a>
        </div>
    </div>

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
                                <picture><img src="<?= Url::to('@web/images/map.jpg') ?>" /></picture>
                            </div>
                            <div class="col-4">
                                <div class="box-itinerary">
                                    <h6 class="m-0 text-dark-blue fw-bold fs-5">North-Central</h6>
                                    <p class="m-0 text-primary">4 days / 3 nights</p>
                                    <p class="m-0 mt-3 text-dark-blue fw-bold">Monday</p>
                                    <p class="m-0 day-description  text-primary"><span>AM</span>Baltra Airport<i
                                            class="bi bi-airplane"></i></p>
                                    <p class="m-0 day-description  text-primary"><span>PM</span>Highlands Tortoise
                                        Reserve (Santa
                                        Cruz)<i class="bi bi-sun"></i></p>
                                    <p class="m-0 mt-3 text-dark-blue fw-bold">Tuesday</p>
                                    <p class="m-0 day-description  text-primary"><span>AM</span>El Barranco, Prince
                                        Philip’s Steps (Genovesa) </p>
                                    <p class="m-0 day-description  text-primary"><span>PM</span>Darwin Bay (Genovesa)
                                    </p>
                                    <p class="m-0 mt-3 text-dark-blue fw-bold">Wednesday</p>
                                    <p class="m-0 day-description  text-primary"><span>AM</span>South Plaza Island</p>
                                    <p class="m-0 day-description  text-primary"><span>PM</span>Santa Fe Island</p>
                                    <p class="m-0 mt-3 text-dark-blue fw-bold">Thursday</p>
                                    <p class="m-0 day-description  text-primary"><span>AM</span>Bachas Beach (Santa
                                        Cruz)</p>
                                    <p class="m-0 day-description  text-primary"><span>PM</span>Baltra Airport<i
                                            class="bi bi-airplane"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasStep2" aria-labelledby="offcanvasStep2Label">

        <div class="offcanvas-body">
            <form>
                <h3 class="title-form text-primary">YOUR SELECTION</h3>
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
                        <label class="label-custom text-primary" for="childrenQty">Children <span>Under 12
                                years</span></label>
                    </div>
                    <div class="col-md-12">
                        <label for="selectMonth" class="form-label text-primary">Estimated Month To
                            Sailling</label>
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
                        <label for="selectShip" class="form-label text-primary">What ship do you
                            want?</label>
                        <select class="form-select form-select-lg" id="selectShip">
                            <option value="1">Galapagos Legend</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="d-grid gap-2 p-3">
            <button class="btn btn-primary btn-lg">Update</button>
            <button class="btn btn-secondary btn-lg" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
        </div>

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