<?php
$this->title = 'Booking Now';

use yii\helpers\Url;

?>
<section class="bg-ocean">
    <div class="clouds"></div>
    <picture class="logo"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>" /></picture>
    <div class="content-pre">
        <h6>join us in an unforgettable adventure</h6>
        <h1 class="text-white">Booking Now</h1>
        <picture><img src="<?= Url::to('@web/images/boat_main.png') ?>" /></picture>
        <div class="container-btns">
            <a class="btn btn-primary btn-lg" href="<?= Yii::getAlias("@web") ?>/site/booking-now-step1/">Start Now</a>
        </div>
    </div>
</section>