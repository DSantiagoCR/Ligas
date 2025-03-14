<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>
<style>    
    .img-bg {
     background-image: url('<?= Yii::getAlias('@web') ?>/backend/web/img/fondo_index2.jpg') ;
      
    }
 </style>
<div class="content-wrapper img-bg">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?php                         
                        if (!is_null($this->title)) {
                            //echo \yii\helpers\Html::encode($this->title);
                        } else {
                            //echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'breadcrumb float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content ">      
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
