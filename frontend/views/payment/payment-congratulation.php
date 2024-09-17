<?php
$this->title = 'Booking Now';
use yii\helpers\Url;
$this->registerJs($this->render('/evento/jquery.blockUI.js'));
?>

<section class="bg-ocean">
    <div class="clouds disable-animation"></div>

    <a id="btn_back" href="<?= Yii::getAlias("@web") ?>/booking/start/">
        <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>
    </a>
    <picture class="animation-boat-stepfinal"><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>

    <div class="container-steps width-1200">

        <div class="container">
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-xl-7">
                    <p class="m-0 text-aqua fs-3 mt-5 pt-3">Congratulations</p>
                    <p class="m-0 text-white fs-1 mb-3">Your Cruise is Booked</p>
                    <p class="m-0 text-white">We send a copy of the receipt to your email with all the information
                        related to your reservation.
                    </p>

                    <div class="row my-5 py-5">
                        <div class="col-12 col-xl-8">
                            <p class="m-0 text-aqua mt-3">Member Of</p>
                            <img src="<?= Url::to('@web/images/logos-ticket.svg') ?>" class="img-logos" />
                        </div>
                        <div class="col-12 col-xl-4">
                            <p class="m-0 text-aqua mt-3">Follow Us</p>
                            <div class="gog-rs">
                                <button type="button" class="btn btn-secondary btn-sm" aria-label="Facebook"><i
                                        class="bi bi-facebook"></i></button>

                                <button type="button" class="btn btn-secondary btn-sm" aria-label="Twitter"><i
                                        class="bi bi-twitter"></i></button>

                                <button type="button" class="btn btn-secondary btn-sm" aria-label="Linkedin"><i
                                        class="bi bi-linkedin"></i></button>

                                <button type="button" class="btn btn-secondary btn-sm" aria-label="Youtube"><i
                                        class="bi bi-youtube"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="ticket-gog">
                        <p class="m-0 text-dark-blue fw-bold fs-4"><?= ($model->ship_id != 'BAR003') ? 'Coral Yatchs' : 'Galapagos Legend' ?></p>
                        <p class="m-0 mb-3 text-primary fs-5"><?= date('d M',strtotime($model->sailing_date))?> - <?= date('d M',strtotime($model->sailing_end_date))?></p>
                        <div class="row">
                            <div class="col">
                                <p class="m-0 text-gray">Hold</p>
                                <div class="d-flex mb-3">
                                    <div class="icon-pdf"><i class="bi bi-filetype-pdf"></i></div>
                                    <div class="px-2">
                                        <p class="m-0 text-primary fw-bold">N° <?= $model->cod_prf ?></p>
                                        <a class="m-0 text-primary" href="<?=$html ?>" target="_blank">Download Quote</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <p class="m-0 text-gray">Itinerary #</p>
                                <p class="m-0 mb-3 text-primary fw-bold fs-5"><?= ($model->itinerary)?$model->itinerary:'PONER ITINERARIO'?></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <p class="m-0 text-gray">Passenger Name</p>
                                <p class="m-0 text-dark-blue fw-bold fs-4"><?= $model->name?></p>
                            </div>
                            <div class="col-6">
                                <p class="m-0 text-gray">Cabin</p>
                                <p class="m-0 text-dark-blue fw-bold"><?= ($model->ship_id != 'BAR003') ? 'Coral Yatchs' : 'Galapagos Legend' ?>
                                    <?php
                                    $cabinasText = '';
                                    foreach ($model->cabins as $cabin)
                                    {
                                        $cabin = (object)$cabin;
                                        ?>
                                        <?=$cabin->cabin_name?>
                                        <?php
                                    }
                                    ?>

                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <p class="m-0 text-gray">Adults</p>
                                <p class="m-0 text-dark-blue fw-bold fs-4"><?= $model->adt?></p>
                            </div>
                            <div class="col-6">
                                <p class="m-0 text-gray">Children</p>
                                <p class="m-0 text-dark-blue fw-bold fs-4"><?= $model->chd?></p>
                            </div>
                        </div>

                        <img src="<?= Url::to('@web/images/footer-ticket.svg') ?>" />
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
<script>
    function mensajeProcesando()
    {
        $.blockUI({
            message: 'Processing please wait...'
        });
    }
    $('#btn_back').click(function () {
        mensajeProcesando();
    })
</script>
