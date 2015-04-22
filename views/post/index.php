<?php
$this->title = \Yii::t('app', 'Posts');
?>
<div class="row wrap">
    <div class="col-sm-9 col-xs-12">
        <?php echo $this->render('/site/_posts', array('data' => $data, 'pagination' => $pagination)); ?>
    </div>
    <div class="col-sm-3 col-xs-12">
    <div>
        <?php echo $this->render('/user/_sidebar'); ?>
    </div>
    </div>
</div>
