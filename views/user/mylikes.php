<?php
    use yii\helpers\Html;
    use yii\widgets\LinkPager;
?>
<div class="row wrap">
    <div class="col-sm-9">
        <?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
        <div class="">
            <?php  echo $this->render('/site/_posts', array('data' => $likepost, 'pagination' => $pagination)); ?>
        </div>
    </div>
    <div class="avatar">
        <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
    </div>
</div>
<div id="shadow"></div>
<div id="photo"></div>
