<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\LatestNews;
?>
</div>
<style>
    .field-image-file_name {
        /*display: none;*/
    }
</style>
<?php
    $a = 0;
    if(strpos($this->context->getRoute(),'user') === 0) { $a = 1; $userX = $modelUser; }    
    if($this->context->getRoute() == 'post/show') { $a = 2; $userX = $author; }
    if ($a > 0) : 
?><div class="col-sm-3" id='user-info' data-id='<?= $userX->id; ?>'>
    
            <p style='font-size:19px' class='text-primary'><?= HTML::a($userX->first_name." ".$userX->last_name, ['user/show', 'username' => $userX->username]); ?></p>
            <div id="forimage">
                    <img style="border-radius: 4px; width:260px; box-shadow:0px 0px 5px #9d9d9d;" src="<?= $userX->getAvatarUrl('bigicon'); ?>">
            </div>
            <?php if (!Yii::$app->user->isGuest && ($userX->id == Yii::$app->user->id) && ($a == 1)) : ?>
            <?php \app\lib\LoadImageWidget::myRun($modelImage, 'image/create', 'form_upload_avatar', 'user', $userX->id); ?>
            <a href="#" class="upload_button" onClick="$('#form_upload_avatar .file_input').trigger('click'); return false;"><b>Змінити аватар</b></a><br>
            <?php if (!empty($userX->vk_id))
                    echo HTML::a('Профіль у ВК', 'http://vk.com/id'.$userX->vk_id, ['target' => '_blank'])."<br>";
                    ?>
            <!--<button id="upload_button">Upload Image</button>-->
            <?php endif; ?>
                <h5 style="color:#008B66;"><i class="glyphicon glyphicon-calendar"><b> День народження:</b></i><?php echo $userX->birthday; ?></h5>
                <h5 style="color:#008B66;"><i class="glyphicon glyphicon-home"><b> Вуз:</b></i><?php echo $userX->vnz; ?></h5>
                <h5 style="color:#008B66;"><i class="glyphicon glyphicon-book"><b> Група:</b></i><?php echo $userX->group_id; ?></h5>
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
<?php if(($this->context->getRoute() == "post/index") || (strpos($this->context->getRoute(),'post') === 0)) : ?>
    
        <div class="col-xs-3">
           <?= LatestNews::widget(['order' => 'ASC', 'limit' => '3']) ?>
        </div>
<?php endif; ?>