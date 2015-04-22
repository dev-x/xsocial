<?php
    use yii\helpers\Html;
    use yii\widgets\LinkPager;
?>
<div class="row wrap">
    <div class="col-sm-9 col-xs-12">
        <?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
        <div class="col-sm-12 Userslikes">
            <?php  echo $this->render('/site/_posts', array('data' => $likepost, 'pagination' => $pagination)); ?>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <div>
        <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
        </div>
    </div>
</div>
