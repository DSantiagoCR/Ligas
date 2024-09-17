<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\bootstrap5\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script defer src="https://use.fontawesome.com/releases/v6.4.0/js/all.js" crossorigin="anonymous"></script>
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"-->
<!--            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">-->
<!--    </script>-->

    <link rel="icon" type="image/x-icon" href="<?= Yii::getAlias("@web")?>/images/favicon-32x32.png">
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <main role="main">
        <?= $content ?>
    </main>

    <?php $this->endBody() ?>

    <script>
    $(function() {
        $('.payment-method').click(function() {
            $('.payment-method').removeClass('selected');
            $(this).addClass('selected');
        })
    })
    /* $(window).on('load', function() {
        setTimeout(function() {
            $('body').css('overflow-y', 'auto')
        }, 1500);
    }) */
    </script>
    <!--     <script src="<?= Yii::getAlias("@web")?>/js/nicescroll.min.js"></script>
    <script>
    jQuery(window).load(function() {
        setTimeout(function() {
            jQuery(".max-height-content-tab").niceScroll({
                cursorwidth: "8px",
                cursorcolor: "#b4b4b4",
                autohidemode: false,
                railpadding: {
                    top: 0,
                    right: 0,
                    left: -12,
                    bottom: 0
                },
                hidecursordelay: 1
            });
            jQuery('.nav-tabs a').on('shown.bs.tab', function(e) {
                jQuery(".max-height-content-tab").getNiceScroll().resize();
            });
            jQuery('.offcanvas').on('shown.bs.offcanvas', function() {
                jQuery(".max-height-content-tab").getNiceScroll().hide();
            });
            jQuery('.offcanvas').on('hidden.bs.offcanvas', function() {
                jQuery(".max-height-content-tab").getNiceScroll().show();
            });
        }, 1500);
    });
    </script> -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
<?php $this->endPage();