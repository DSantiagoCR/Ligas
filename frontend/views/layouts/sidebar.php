<?php
use \common\models\Util\ScriptMenu;
//Utilizamos la CLase MemuLogic, para traer el listaoo de menus
$objMenuLogic = new ScriptMenu();
$arrayMenuItems = $objMenuLogic->obtenerMenuFrontend();

// echo '<pre>';
// print_r($arrayMenuItems);
// die();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="">
    <!-- Brand Logo -->
        <a href="<?=Yii::getAlias('@web')?>/site/index" class="brand-link">
            <img src="<?=Yii::getAlias('@web')?>/administrator/img/pi.jpg" alt="Logo Ligas" class="brand-image img-circle elevation-3" style="opacity: 10">
            <span class="brand-text font-weight-light"><b>Ligas</b></span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="m-0 row justify-content-center">
                    <div class="col">
                        <div class="image">
                            <img src="<?=Yii::getAlias('@web')?>/administrator//img/user_imagen.jpg" class="img-circle elevation-5 align-content-md-center" alt="User Image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="info">
                            <span style="font-size: 14px;color:white;">
                                <?=isset(Yii::$app->user->identity->username)?strtoupper(Yii::$app->user->identity->username):'' ?>
                            </span>
                        </div>
                    </div>
                </div>
        </div>


        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
         <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items'=>$arrayMenuItems,

            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>