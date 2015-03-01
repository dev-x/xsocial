<div class="row wrap">
    <div class="col-sm-9 col-xs-12">
        <?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
        <div id="kartinka" style="margin-top:15px;" class="col-sm-12">
                <?php foreach ($modelUser->userImages as $image) : ?>
                    <?php $src =  Yii::$app->homeUrl."content/".$image->file_name."_m".$image->file_ext; ?>
                    <a href="<?= $src; ?>" rel="prettyPhoto[x]"><img  class="imge" src="<?= $src; ?>"></a>
                <?php endforeach; ?>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <div>
            <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
        </div>
    </div>
</div>
