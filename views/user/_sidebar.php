<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
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
?><div class="col-sm-3">
    
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
        </div>
<?php endif; ?>
<?php if(($this->context->getRoute() == "post/index") || (strpos($this->context->getRoute(),'post') === 0)) : ?>
    
        <div class="col-xs-3">
            <h3 style="color:#008B66;font-style: italic;">Останні пости</h3>
            <?php foreach ($postSidebar as $post) : ?>
                <div class="panel panel-default">
                    <div style="background-color:#00A87B;" class="panel-heading"><p style="margin-left:10px; font-size:20px;color:#fff;font-style: italic;"><?php echo $post->title."<br>"; ?></p></div>
                    <div class="panel-body">
                            <?php if ($post->images) foreach($post->images as $postImage): ?>
                            <?php //echo $postImage->getImageUrl('small'); ?>
                                    <img style="width:80px; margin:0px 5px 2px 2px; float:left;box-shadow:0 0 2px #9d9d9d;" src="<?php echo $postImage->getImageUrl('small'); ?>">
                            <?php    break;
                             endforeach; ?>
                        <div style="width:100%;">
                            <?= mb_substr($post->content, 0, 100, "UTF-8")."..."; ?>
                        </div>
                        <button type="submit" class="btn btn-default pull-right"><?php  echo Html::a("Дочитати", array('post/show', 'id'=>$post->id));  ?></button>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
<?php endif; ?>