<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = strip_tags(Yii::t('payment/detalle-pago', 'Detalle Pago'));

if ($model['status'] == 'PENDING') {
    $model['status'] = 'Pendiente';
} elseif ($model['status'] == 'REJECTED') {
    $model['status'] = 'Rechazado';
} else {
    $model['status'] = 'Aprobado';
}
?>

<div class="container-fluid px-0">
    <div class="container mx-auto mt-4">
        <div class="col-lg-12">
            <div class="rounded p-2 border">
                <div class="text-center">
                    <label>INFORMACIÓN DEL ULTIMO PAGO REALIZADO</label>
                </div>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'message',
                        'reference',
                        'status',
                        'monto',
                        'fec_create',
                    ],
                ]) ?>
            </div>
            <br>
            <?php if ($model['status'] == 'Pendiente') : ?>
                <div class="alert alert-warning" role="alert">
                    Este link de pago ya ha sido procesado, el estado su pago esta pendiente. Por favor espere mientras se procesa su pago.
                </div>
            <?php endif; ?>
            <?php if ($model['status'] == 'Rechazado') : ?>
                <div class="alert alert-danger" role="alert">
                    Este link de pago ya ha sido procesado, el estado de su pago es rechazado. Por favor comuniquese con su agente de ventas para generar un nuevo link de pago.
                </div>
            <?php endif; ?>
            <?php if ($model['status'] == 'Aprobado') : ?>
                <div class="alert alert-primary" role="alert">
                    Este link de pago ya ha sido procesado, el estado de su pago es aprovado. Por favor comuniquese con su agente de ventas para generar un nuevo link de pago.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>