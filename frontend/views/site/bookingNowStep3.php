<?php
$this->title = 'Booking Now';
use yii\helpers\Url;
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
                        <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2">My Cabins
                            Selection</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1">
                        <div class="max-height-content-tab w-padding">
                            <div class="row row-cols-1 row-cols-md-2 g-3">
                                <div class="col">
                                    <div class="card">
                                        <div id="carouselExampleIndicators" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="0" class="active" aria-current="true"
                                                    aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                                            </div>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                                        class="d-block w-100" />
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                                        class="d-block w-100" />
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                                        class="d-block w-100" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body-go">
                                            <h4>Legend Balcony Suite</h4>
                                            <div class="card-content-go">
                                                <p><b>From</b> <span>$4.097</span> per person</p>
                                                <ul>
                                                    <li>1 cabin located in the Moon Deck
                                                    </li>
                                                    <li>Double & Triple options</li>
                                                    <li>Panoramic windows & private balcony</li>
                                                    <li>Exclusive & exquisite decoration</li>
                                                    <li>Complimentary bottle of champagne</li>
                                                    <li>Average Area 33 m2 / 355 ft2</li>
                                                </ul>
                                            </div>
                                            <div class="card-footer-go row g-2">
                                                <div class="col">
                                                    <select class="form-select" aria-label="Select a option">
                                                        <optgroup label="Single">
                                                            <option value="1">1 Adult</option>
                                                        </optgroup>
                                                        <optgroup label="Double">
                                                            <option value="2">2 Adults</option>
                                                            <option value="3">1 Adult / 1 Child</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-warning">Confirm Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <div id="carouselExampleIndicators" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="0" class="active" aria-current="true"
                                                    aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                                            </div>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                                        class="d-block w-100" />
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                                        class="d-block w-100" />
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                                        class="d-block w-100" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body-go">
                                            <h4>Balcony Suite</h4>
                                            <div class="card-content-go">
                                                <p><b>From</b> <span>$3.097</span> per person</p>
                                                <ul>
                                                    <li>1 cabin located in the Moon Deck
                                                    </li>
                                                    <li>Double & Triple options</li>
                                                    <li>Panoramic windows & private balcony</li>
                                                    <li>Exclusive & exquisite decoration</li>
                                                    <li>Complimentary bottle of champagne</li>
                                                    <li>Average Area 33 m2 / 355 ft2</li>
                                                </ul>
                                            </div>
                                            <div class="card-footer-go row g-2">
                                                <div class="col">
                                                    <select class="form-select" aria-label="Select a option" disabled>
                                                        <optgroup label="Single">
                                                            <option value="1">1 Adult</option>
                                                        </optgroup>
                                                        <optgroup label="Double">
                                                            <option value="2">2 Adults</option>
                                                            <option value="3">1 Adult / 1 Child</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-warning" disabled>Confirm
                                                        Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <div class="max-height-content-tab w-padding">
                            <div class="row g-3 border-bottom mb-3">
                                <div class="col-12 col-md-4 m-0 p-2 pt-3 pb-3"><img
                                        src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                        class="d-block w-100 rounded" /></div>
                                <div class="col-12 col-md-8 m-0 p-2 pt-3 pb-3">
                                    <div class="flex-zm-justify mb-3 item-title-w-icon">
                                        <p class="fs-4 m-0 fw-bold">Legend Balcony Suite</p>
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                    </div>
                                    <div class="row g-3 mt-0">
                                        <div class="col-12 col-md-6 m-0 p-2">
                                            <div class="info-item-zm"><span class="text-price fs-5 fw-bold">2</span>
                                                ADULTS</div>
                                        </div>
                                        <div class="col-12 col-md-6 m-0 p-2">
                                            <div class="info-item-zm">CABIN PRICE <span
                                                    class="text-price fs-5 fw-bold">$8.194*</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-zm-justify item-price-zm">
                                        <p><b>Pax #1</b> (Adult)</p>
                                        <p>Price <b>$4.097*</b></p>
                                    </div>
                                    <div class="flex-zm-justify item-price-zm">
                                        <p><b>Pax #2</b> (Adult)</p>
                                        <p>Price <b>$4.097*</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 border-bottom mb-2">
                                <div class="col-12 col-md-4 m-0 p-2 pt-3 pb-3"><img
                                        src="<?= Url::to('@web/images/img-journey.jpg') ?>"
                                        class="d-block w-100 rounded" /></div>
                                <div class="col-12 col-md-8 m-0 p-2 pt-3 pb-3">
                                    <div class="flex-zm-justify mb-3 item-title-w-icon">
                                        <p class="fs-4 m-0 fw-bold">Junior Suite</p>
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                    </div>
                                    <div class="row g-3 mt-0">
                                        <div class="col-12 col-md-6 m-0 p-2">
                                            <div class="info-item-zm"><span class="text-price fs-5 fw-bold">1</span>
                                                CHILDREN</div>
                                        </div>
                                        <div class="col-12 col-md-6 m-0 p-2">
                                            <div class="info-item-zm">CABIN PRICE <span
                                                    class="text-price fs-5 fw-bold">$2.097*</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-zm-justify item-price-zm">
                                        <p><b>Pax #3</b> (Children)</p>
                                        <p>Price <b>$2.097*</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-zm-justify border-bottom total-price-m-negative">
                                <p class="fs-5 m-0 fw-bold text-price">Estimated Price</p>
                                <p class="fs-4 m-0 fw-bold text-price">$10.291.00*</p>
                            </div>

                            <p class="fs-4 m-0 mb-2 fw-bold text-primary text-center">Upgrade option</p>
                            <div class="upgrade-container">
                                <div class="row g-3 align-items-center">
                                    <div class="col-12 col-md-8">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <img src="<?= Url::to('@web/images/img-journey.jpg') ?>" class="rounded"
                                                    width="100%" />
                                            </div>
                                            <div class="col-auto">
                                                <img src="<?= Url::to('@web/images/arrow-images.svg') ?>" />
                                            </div>
                                            <div class="col">
                                                <img src="<?= Url::to('@web/images/img-journey.jpg') ?>" class="rounded"
                                                    width="100%" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="m-0 mb-2 fw-bold text-primary">Upgrade from Junior Suite to Balcony
                                            Suite for
                                            1,000 USD*</p>

                                        <div class="card-content-go p-0">
                                            <ul>
                                                <li>1 cabin located in the Moon Deck
                                                </li>
                                                <li>Double & Triple options</li>
                                            </ul>
                                        </div>
                                        <div class="d-grid mt-2">
                                            <button type="button" class="btn btn-warning">Select this
                                                Upgrade</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-down-content"><span><i class="bi bi-chevron-down"></i>Scroll for more
                    information</span></div>
        </div>
        <div class="d-grid gap-2 fix-size-btns-footer">
            <a class="btn btn-primary btn-lg" href="<?= Yii::getAlias("@web") ?>/site/booking-now-step4/">Book your
                journey</a>
            <a class="btn btn-outline-light btn-lg border-0"
                href="<?= Yii::getAlias("@web") ?>/site/booking-now-step2/">Back</a>
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
    </div>
</section>