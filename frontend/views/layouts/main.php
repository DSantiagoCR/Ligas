<?php

/** @var \yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\Html;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);

frontend\assets\AppAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['sweetalert2', 'toastr']);

AppAsset::register($this);


?>
<style>    
    .img-bg {
     background-image: url('<?= Yii::getAlias('@web') ?>/backend/web/img/fondo_index2.jpg') ;
     height: 100%; 
    }
 </style>
 
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode('Ligas - ' . $this->title) ?></title>
    <link rel="shortcut icon" type="image/ico" href="<?= Yii::getAlias('@web') ?>/img/pi.jps">
    <?php $this->head() ?>

    <link href="<?= Yii::getAlias('@web') ?>/css/bootstrap4/css/bootstrap-glyphicons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->render('navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->render('sidebar') ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->render('content', ['content' => $content]) ?>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <!-- <?= $this->render('control-sidebar') ?> -->
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?= $this->render('footer') ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>