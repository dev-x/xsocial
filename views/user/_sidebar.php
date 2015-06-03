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
            <img style="border-radius: 1px;width:100%;box-shadow:0px 0px 5px #337ab7;-webkit-box-shadow: 0 5px 5px #337ab7;" src="<?= $userX->getAvatarUrl('bigicon'); ?>">
        </div>
        <?php if (!Yii::$app->user->isGuest && ($userX->id == Yii::$app->user->id) && ($a == 1)) : ?>
        <?php \app\lib\LoadImageWidget::myRun($modelImage, 'image/create', 'form_upload_avatar', 'user', $userX->id); ?>
        <a href="#" class="upload_button" onClick="$('#form_upload_avatar .file_input').trigger('click'); return false;"><b><?= \Yii::t('app', 'Change avatar')?></b></a><br>
        <?php if (!empty($userX->vk_id))
                echo HTML::a(\Yii::t('app', 'VK Profile'), 'http://vk.com/id'.$userX->vk_id, ['target' => '_blank'])."<br>";
                ?>
        <!--<button id="upload_button">Upload Image</button>-->
        <?php endif; ?>
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