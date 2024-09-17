<?php
$this->title = 'Booking Now';
use yii\helpers\Url;
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
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= Url::to('@web/images/image-card-step4.jpg') ?>"
                                    class="img-fluid rounded-zm">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body px-3">
                                    <div class="card-body-go">
                                        <div class="flex-zm-justify pb-2">
                                            <p class="text-primary fs-4 fw-bold m-0">3 nights in Quito city pack</p>
                                            <input class="form-check-input" type="checkbox" value="" checked>
                                        </div>
                                        <div class="card-content-go p-0">
                                            <p class="mb-2"><b>From</b> <span>$500</span> per person</p>
                                            <ul>
                                                <li>1 cabin located in the Moon Deck
                                                </li>
                                                <li>Double & Triple options</li>
                                                <li>Panoramic windows & private balcony</li>
                                                <li>Exclusive & exquisite decoration</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= Url::to('@web/images/image-card-step4.jpg') ?>"
                                    class="img-fluid rounded-zm">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body px-3">
                                    <div class="card-body-go">
                                        <div class="flex-zm-justify pb-2">
                                            <p class="text-primary fs-4 fw-bold m-0">3 nights in Quito city pack</p>
                                            <input class="form-check-input" type="checkbox" value="" checked>
                                        </div>
                                        <div class="card-content-go p-0">
                                            <p class="mb-2"><b>From</b> <span>$500</span> per person</p>
                                            <ul>
                                                <li>1 cabin located in the Moon Deck
                                                </li>
                                                <li>Double & Triple options</li>
                                                <li>Panoramic windows & private balcony</li>
                                                <li>Exclusive & exquisite decoration</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-primary fs-5 fw-bold mb-2">Land Services</p>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= Url::to('@web/images/image-card-step4.jpg') ?>"
                                    class="img-fluid rounded-zm">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body px-3">
                                    <div class="card-body-go">
                                        <div class="flex-zm-justify pb-2">
                                            <p class="text-primary fs-4 fw-bold m-0">3 nights in Quito city pack</p>
                                            <input class="form-check-input" type="checkbox" value="" checked>
                                        </div>
                                        <div class="card-content-go p-0">
                                            <p class="mb-2"><b>From</b> <span>$500</span> per person</p>
                                            <ul>
                                                <li>1 cabin located in the Moon Deck
                                                </li>
                                                <li>Double & Triple options</li>
                                                <li>Panoramic windows & private balcony</li>
                                                <li>Exclusive & exquisite decoration</li>
                                            </ul>
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

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="d-grid">
                        <a class="btn btn-outline-secondary btn-lg"
                            href="<?= Yii::getAlias("@web") ?>/site/booking-now-step5/">Skip</a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-grid">
                        <a class="btn btn-primary btn-lg"
                            href="<?= Yii::getAlias("@web") ?>/site/booking-now-step5/">Continue</a>
                    </div>
                </div>
            </div>
            <a class="btn btn-outline-light btn-lg border-0"
                href="<?= Yii::getAlias("@web") ?>/site/booking-now-step3/">Back</a>
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