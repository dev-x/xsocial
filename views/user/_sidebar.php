<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\LatestNews;
?>
</div>
<?php
    $a = 0;
    if(strpos($this->context->getRoute(),'user') === 0) { $a = 1; $userX = $modelUser;}
    if(strpos($this->context->getRoute(),'index') == '9'){$a = 1; $userX = $modelUser;}
    if($this->context->getRoute() == 'post/show') { $a = 2; $userX = $author; }
    if ($a > 0) : 
?>
<div class="col-sm-12" style="padding:0px;">
    <div id='user-info' data-id='<?= $userX->id; ?>'>
        <p class='text-primary username'>
            <?= HTML::a($userX->first_name." ".$userX->last_name, ['user/show', 'username' => $userX->username]); ?>
        </p>
        <div id="forimage" class="SibedarUserAvatar">
            <img style="border:1px solid grey;border-radius: 4px;width:100%;box-shadow:0px 0px 5px #9d9d9d;-webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);" src="<?= $userX->getAvatarUrl('bigicon'); ?>">
        </div>
        <?php if (!Yii::$app->user->isGuest && ($userX->id == Yii::$app->user->id) && ($a == 1)) : ?>
        <?php \app\lib\LoadImageWidget::myRun($modelImage, 'image/create', 'form_upload_avatar', 'user', $userX->id); ?>
        <a href="#" class="upload_button" onClick="$('#form_upload_avatar .file_input').trigger('click'); return false;"><b><?= \Yii::t('app', 'Change avatar')?></b></a><br>
        <?php if (!empty($userX->vk_id))
                echo HTML::a(\Yii::t('app', 'VK Profile'), 'http://vk.com/id'.$userX->vk_id, ['target' => '_blank'])."<br>";
                ?>
        <!--<button id="upload_button">Upload Image</button>-->
        <?php endif; ?>
            <h5 style="color:#008B66;"><i class="glyphicon glyphicon-calendar"><b><?= \Yii::t('app', 'Birthday') ?>:</b></i><?php echo $userX->birthday; ?></h5>
            <h5 style="color:#008B66;"><i class="glyphicon glyphicon-home"><b><?= \Yii::t('app', 'Higt School') ?>:</b></i><?php echo $userX->vnz; ?></h5>
            <h5 style="color:#008B66;"><i class="glyphicon glyphicon-book"><b><?= \Yii::t('app', 'Class') ?>:</b></i><?php echo $userX->group; ?></h5>
             <?php if (!Yii::$app->user->isGuest && ($userX->id != Yii::$app->user->id)){
                if (Yii::$app->user->identity->isFollowingTo($userX->id)){
                    $but_action = 'unfollow';
                    $but_title = 'Відписатися';
                } else {
                    $but_action = 'follow';
                    $but_title = 'Підписатися';
                }    
        ?>
            <a href="#" class='btn btn-default follow-button' data-action='<?= $but_action; ?>' ><?= $but_title; ?></a>
        <?php } ?>
    </div>
<?php endif; ?>
<?php if(($this->context->getRoute() == "search") || ($this->context->getRoute() == "post/index") || (strpos($this->context->getRoute(),'post') === 0)) : ?>
    <div class="col-sm-12" style="padding:0px;">    
        <?= LatestNews::widget(['order' => 'DESC', 'limit' => '3']) ?>
    </div>
<?php endif; ?>
</div>