<?php
    use yii\helpers\Html;
?>
<div class="row wrap">
        <div class="col-sm-9 col-xs-12">
        <?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
            <div class="page-header clearfix">
                <div style="width:80%;float:left;font-color:green;" class="col-sm-10"><p style="font-size:18px;"><?php echo HTML::a(\Yii::t('app', 'Main info'));?></p></div>
                <div style="width:20%;float:left;" class="col-sm-2">
                    <?php
                        if (Yii::$app->user->id === $modelUser->id){
                            echo HTML::a(\Yii::t('app', 'Update'),array('edit','id'=>$modelUser->id));
                            echo " | ";
                            echo HTML::a(\Yii::t('app', 'Add VK Profile'),'http://oauth.vk.com/authorize?client_id=4190651&redirect_uri='.\Yii::$app->getUrlManager()->createAbsoluteUrl('site/addvk').'&scope=offline&display=page&response_type=code');
                        //HTML::url('site/addvk')
                            //
                            //\Yii::$app->getUrlManager()->createUrl();
                        }
                        ?>
                </div>
            </div>
        <div class="col-sm-12">
            <?= \Yii::t('app', 'Name')?>:<strong><?= $modelUser->first_name; ?></strong><br>
            <?= \Yii::t('app', 'Surname')?>:<strong><?= $modelUser->last_name; ?></strong><br>
            <span style="color:green;" class="glyphicon glyphicon-phone"> </span><?php if($modelUser->mobil != 0){ echo \Yii::t('app', 'Mobile number').":<strong>".$modelUser->mobil.""; }else{}; ?></strong><br>
            <span style="color:green;" class="glyphicon glyphicon-envelope"> </span><?php if($modelUser->email != null){ echo \Yii::t('app', 'Email').":<strong>".$modelUser->email.""; } ?></strong>
        </div>
        <div class="col-sm-12">
            <span style="color:green;" class="glyphicon glyphicon-envelope"></span><?php if($modelUser->city_id != null){ echo \Yii::t('app', 'City').":<strong>".$modelUser->city_id."</br>"; } ?></strong>
            <?php if($modelUser->vnz != null){ echo \Yii::t('app', 'Higt School').":<strong>".$modelUser->vnz."</br>"; } ?></strong>
            <?php if($modelUser->group != null){ echo \Yii::t('app', 'Class').":<strong>".$modelUser->group."</br>"; } ?></strong>
            <span style="color:green;" class="glyphicon glyphicon-calendar"></span><?php if($modelUser->birthday != 0000-00-00){ echo \Yii::t('app', 'Birthday').":<strong>".$modelUser->birthday."</br>"; } ?></strong>
            <?php if($modelUser->skype != null){ echo \Yii::t('app', 'Skype').":<strong>".$modelUser->skype."</br>"; } ?></strong>
            <?php if($modelUser->myCredo != null){ echo \Yii::t('app', 'Credo').":<strong>".$modelUser->myCredo."</br>"; } ?></strong>
            <?php if($modelUser->myInfo != null){ echo \Yii::t('app', 'Other info about myself').":<strong>".$modelUser->myInfo."</br>"; } ?></strong>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <div class="avatar">
            <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
        </div>
    </div>
</div>
