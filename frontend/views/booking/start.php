<?php
$this->title = 'Booking Now';

use yii\helpers\Url;

?>
<section class="bg-ocean">
    <div class="clouds"></div>
    <picture class="logo"><img src="<?= Url::to('@web/images/gogalapagos_logo.svg') ?>"/></picture>
    <div class="content-pre">
        <h6>Your Expedition begins here</h6>
        <h1 class="text-white">Booking Now</h1>
        <picture><img src="<?= Url::to('@web/images/boat_main.png') ?>"/></picture>
        <div class="container-btns">
            <a class="btn btn-primary-2 btn-lg" href="<?= Yii::getAlias("@web") ?>/booking/step-form/">Start Now</a>
        </div>
    </div>
</section>
