<?php
    use yii\helpers\Html;
?>

<style>
    #infoTwo{
        display:none;
    }
</style>
<div class="row wrap">
        <div class="col-sm-9">
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
                <div style="margin-left:20px;">
                <table>
                    <tr>
                        <td><?= \Yii::t('app', 'Name')?>: </td><td><strong><?= $modelUser->first_name; ?></strong></td>
                    </tr>
                    <tr>
                        <td><?= \Yii::t('app', 'Surname')?>: </td><td><strong><?= $modelUser->last_name; ?></strong></td>
                    </tr>
                    <tr>
                        <td><?php if($modelUser->mobil != 0){ echo \Yii::t('app', 'Mobile number').":</td><td><strong>".$modelUser->mobil.""; }else{}; ?></strong></td>
                    </tr>
                    <tr>
                        <td><?php if($modelUser->email != null){ echo \Yii::t('app', 'Email').":</td><td><strong>".$modelUser->email.""; } ?></strong></td>
                    </tr>
                </table>
            </div>
        <?php /* if(($modelUser->city && $modelUser->vnz && $modelUser->group_id && $modelUser->skype && $modelUser->myCredo && $modelUser->myInfo != null ) && ($modelUser->birthday != 0000-00-00)){ */ ?>
        <div id="drygor">
        <div class="page-header clearfix">

                <div style="width:93%;float:left;font-color:green;" class="col-sm-11"><p style="font-size:18px;"><?php echo HTML::a(\Yii::t('app', 'Other info'));?></p></div>
                <div style="width:5%;float:left;" class="col-sm-1">
                    <a type="submit"><p id="disp"><?=\Yii::t('app', 'Open')?></p></a>
                </div>
        </div>
        <div id="infoTwo" style="margin-left:20px;padding-bottom:20px;">
            <?php if($modelUser->city != null){ echo \Yii::t('app', 'City').":<strong>".$modelUser->city."</br>"; } ?></strong>
            <?php if($modelUser->vnz != null){ echo \Yii::t('app', 'Higt School').":<strong>".$modelUser->vnz."</br>"; } ?></strong>
            <?php if($modelUser->group_id != null){ echo \Yii::t('app', 'Class').":<strong>".$modelUser->group_id."</br>"; } ?></strong>
            <?php if($modelUser->birthday != 0000-00-00){ echo \Yii::t('app', 'Birthday').":<strong>".$modelUser->birthday."</br>"; } ?></strong>
            <?php if($modelUser->skype != null){ echo \Yii::t('app', 'Skype').":<strong>".$modelUser->skype."</br>"; } ?></strong>
            <?php if($modelUser->myCredo != null){ echo \Yii::t('app', 'Credo').":<strong>".$modelUser->myCredo."</br>"; } ?></strong>
            <?php if($modelUser->myInfo != null){ echo \Yii::t('app', 'Other info about myself').":<strong>".$modelUser->myInfo."</br>"; } ?></strong>
        </div>
        </div>
        <?php /* } */?>
    </div>
    <div class="avatar">
        <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
    </div>
</div>
