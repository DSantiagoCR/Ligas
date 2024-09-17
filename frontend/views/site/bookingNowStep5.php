<?php
$this->title = 'Booking Now';
use yii\helpers\Url;
?>
<section class="bg-ocean">
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
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Sailing Date</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue">2023-02-16</p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Ship</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue">Galapagos Legend</p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Itinerary</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue"><a href="#"
                                        class="fw-normal text-primary">(View Itinerary)</a> North-Central</p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Cruise Duration</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue">5 days cruise</p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Guests</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue">2 Adults, 1 Children</p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="flex-zm-justify">
                                <p class="m-0 pt-1 pb-1 text-dark-blue">Cabins</p>
                                <p class="m-0 pt-1 pb-1 fw-bold text-dark-blue">Legend Balcony Suite, Junior Suite
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
                                    <span class="m-0 pt-1 pb-1 text-dark-blue">Cruise Total</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$10.291,00
                                    </span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse1" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-heading1">
                                <div class="accordion-body">
                                    <div class="flex-zm-justify item-price-zm title">
                                        <p><b>Legend Balcony Suite</b></p>
                                    </div>
                                    <div class="flex-zm-justify item-price-zm">
                                        <p><b>Pax #1</b> (Adult)</p>
                                        <p>Price <b>$4.097*</b></p>
                                    </div>
                                    <div class="flex-zm-justify item-price-zm">
                                        <p><b>Pax #2</b> (Adult)</p>
                                        <p>Price <b>$4.097*</b></p>
                                    </div>
                                    <div class="flex-zm-justify item-price-zm title">
                                        <p><b>Junior Suite</b></p>
                                    </div>
                                    <div class="flex-zm-justify item-price-zm">
                                        <p><b>Pax #3</b> (Children)</p>
                                        <p>Price <b>$2.097*</b></p>
                                    </div>
                                    <div class="flex-zm-justify item-price-zm total">
                                        <p><b>Total</b></p>
                                        <p>Price <b>$10.291*</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading2">

                                <button class="accordion-button collapsed flex-zm-justify" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse2"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapse2">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue">Extra Services</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$800,00
                                    </span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse2" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-heading2">
                                <div class="accordion-body">
                                    <p>Contenido
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading3">

                                <button class="accordion-button collapsed flex-zm-justify" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse3"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapse3">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue"><input
                                            class="form-check-input fix-checkbox-margin" type="checkbox" value="">
                                        Ticket round trip from Quito or Guayaquil
                                        to Galapagos</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$399,00
                                    </span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse3" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-heading2">
                                <div class="accordion-body">
                                    <p>Contenido
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading4">

                                <button class="accordion-button collapsed flex-zm-justify" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse4"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapse4">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue"><input
                                            class="form-check-input fix-checkbox-margin" type="checkbox" value="">
                                        Entrace fee to Galapagos</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$6,00
                                    </span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse4" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-heading2">
                                <div class="accordion-body">
                                    <p>Contenido
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading5">

                                <button class="accordion-button collapsed flex-zm-justify" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse5"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapse5">
                                    <span class="m-0 pt-1 pb-1 text-dark-blue"><input
                                            class="form-check-input fix-checkbox-margin" type="checkbox" value="">
                                        Migration control card</span>
                                    <span class="m-0 pt-1 pb-1 fw-bold text-dark-blue">$20,00
                                    </span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse5" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-heading2">
                                <div class="accordion-body">
                                    <p>Contenido
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-zm-justify border-bottom p-2 px-0">
                            <p class="fs-5 m-0 fw-bold text-price">Total Price</p>
                            <p class="fs-4 m-0 fw-bold text-price">$11.610.00*</p>
                        </div>
                    </div>

                    <p class="fs-5 text-primary m-0 title-letter mt-5"><b>B</b>Personal Information</p>
                    <form class="row g-3 py-3">
                        <div class="col-md-6">
                            <select class="form-select">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="col-md-6">
                            <input type="tel" class="form-control" placeholder="Teléfono">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Correo electrónico">
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
                        <a class="btn btn-primary btn-lg"
                            href="<?= Yii::getAlias("@web") ?>/site/booking-now-quote/">Get a quote</a>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="d-grid">
                        <a class="btn btn-primary btn-lg" href="<?= Yii::getAlias("@web") ?>/site/booking-now-hold/">24H
                            courtesy hold</a>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="d-grid">
                        <a class="btn btn-primary btn-lg"
                            href="<?= Yii::getAlias("@web") ?>/site/booking-now-step6/">Payment</a>
                    </div>
                </div>
            </div>
            <a class="btn btn-outline-light btn-lg border-0"
                href="<?= Yii::getAlias("@web") ?>/site/booking-now-step4/">Back</a>
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

</section>