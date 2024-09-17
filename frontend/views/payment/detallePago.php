<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = strip_tags(Yii::t('payment/detalle-pago', 'Detalle Pago'));

?>
<section class="bg-ocean">
    <div class="clouds disable-animation"></div>
    <picture class="logo disable-animation"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>
    <picture class="animation-boat-step6"><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>
    <div class="container-steps width-1000">
        <h4 class="title-steps text-white">INFORMATION OF THE LAST PAYMENT MADE</h4>
        <div class="card">
            <div class="card-body pb-0">

                <div class="max-height-content-tab pb-2">
                    <p class="fs-5 text-primary m-0 title-letter"><b>A</b>GOGALAPAGOS BY KLEINTOURS</p>
                    <ul class="list-group list-group-flush border-bottom">
                        <li class="list-group-item">
                            <div class="flex-zm-justify">

                            </div>
                        </li>
                    </ul>

                </div>

                <div class="container-fluid px-0">
                    <div class="container mx-auto mt-4">
                        <div class="col-lg-12">
                            <div class="rounded p-2 border">
                                <div class="text-center">
                                    <label>INFORMATION OF THE LAST PAYMENT MADE</label>
                                </div>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'reference',
                                        'status',
                                        'monto',
                                        'fec_create',
                                    ],
                                ]) ?>
                            </div>
                            <br>
                            <?php if ($model['status'] == 'Begin') : ?>
                                <div class="alert alert-warning" role="alert">
                                    This link of payment has being processed, the status of your payment is Pending. Please wait while your payment is processed.
                                </div>
                            <?php endif; ?>
                            <?php if ($model['status'] == 'Cancelled') : ?>
                                <div class="alert alert-danger" role="alert">
                                    This link of payment has being processed, the status of your payment is Cancelled. Please contact your sales agent to generate a new payment link.
                                </div>
                            <?php endif; ?>
                            <?php if ($model['status'] == 'Confirmation') : ?>
                                <div class="alert alert-primary" role="alert">
                                    This link of payment has being processed, the status of you payment if Confirmation. Please contact your sales agent to generate a new payment link for future payments.
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

