<?php
$this->title = \Yii::t('app', 'Posts');
?>
<div class="row wrap">
    <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
        <?php echo $this->render('/site/_posts', array('data' => $data, 'pagination' => $pagination)); ?>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
        <div>
            <?php echo $this->render('/user/_sidebar'); ?>
        </div>
    </div>
</div>
