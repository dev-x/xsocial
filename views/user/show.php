<?php
use yii\widgets\ActiveForm;
use yii\helpers\HTML;
use yii\helpers\Url;
$this->title = $modelUser->username;
//$this->some_var;
?>
<script type="text/template" id="template-image-element">
    <span align="center" class="imgPicture">
        <img src="<%= src %>" rel="prettyPhoto" alt="Картинка 1" border="0">
    </span>
</script>
<script type="text/template" id="template-post-element">
    <div class="row">
            <div class="col-sm-1 userAvatarPost">
                <img src="<%= avatarUrl %>">
            </div>
                    <div class="col-sm-11" id="parent_info">
                        <div class="col-sm-12">
                            <ul class="list-inline">
                                <li><p class="usernameOnPost"><a href="<%= authorUrl %>"><%= authorName %></a></p></li>
                                <li><span class="glyphicon glyphicon-time"></span><i><%= timePost %></i></li>
                            </ul>
                        </div>
                        <div class="col-sm-12">
                            <p class="postTitle"><a href="<%= titleUrl %>"><%= titlePost %></a></p>
                        </div>
                        <div class="col-sm-12">
                            <div class="conte"><%= contentPost %></div>
                        </div>
                        <div class="col-sm-12">
                            <div style="margin-bottom:10px;" class="post_images" >
                                  
                            </div>
                        </div>
                        <ul class="list-inline">
                                <li style="float:right;"><a href=""><i class="glyphicon glyphicon-comment"><%= commentCountPost %></i></a></li>                               
                                <li style="float:right;"><a href="" class="like_button" id='<%= id %>' data-id='<%= id %>' data-type='Post' data-action="likeon"><%= likeСount %><i id="likes_view<%= id %>" class="glyphicon glyphicon-heart-empty"></i></a></li>
                        </ul>
                    </div>    
                </div>   
            <hr>
</script>
<div class="row wrap">
    <div class="col-sm-9  col-xs-12">
            <?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
            <?php
                if (!Yii::$app->user->isGuest && (Yii::$app->user->id == $modelUser->id) && ($modelUser->dozvil == 1)) {
                    $edit_action = Url::toRoute('post/edit');
                    if ($modelNewPost->id)
                        $action =  Url::toRoute(['post/edit', 'id' => $modelNewPost->id]);
                    else
                        $action =  Url::toRoute('post/create');
                    ?>
                <div style="padding:20px;margin-top:50px; background-color:#F7FFFE;" class="well bs-component" id="qw">
                        <?php  /* needfix $form = ActiveForm::begin(['id' => 'PostNew', 'action' => $action, 'options' => ['data-edit' => $edit_action], 'beforeSubmit' => new \yii\web\JsExpression('submitPost')]); */ ?>
                        <?php $form = ActiveForm::begin(['id' => 'PostNew', 'action' => $action, 'options' => ['data-edit' => $edit_action,'data-new' => $action]]); ?>
                            <?= $form->field($modelNewPost, 'title')->textInput(['placeholder' => \Yii::t('app', 'Title')]); ?>
                        <div id="newPostContent" <?php if (!$modelNewPost->id) echo 'style="display:none;"'; ?> >
                            <?= $form->field($modelNewPost, 'content')->textArea(['rows' => 6 , 'placeholder' => \Yii::t('app', 'Text of new post'), 'style'=>'max-widht:800px;']); ?>
                            <?= $form->field($modelNewPost, 'post_type')->dropDownList($list); ?>
                            <!--'class'=>'widgEditor nothing-->
                            <?= Html::input('submit', 'submit_save',  \Yii::t('app', 'Save'), ['class' => 'btn-submit btn btn-primary']); ?>
                            <?= Html::input('submit', 'submit_publish', \Yii::t('app', 'Publish'), ['class' => 'btn-submit btn btn-primary']); ?>
                            <!-- <div id="my-form-alert" class="alert alert-success" role="alert"></div>-->
                        <?php ActiveForm::end(); ?>
                    <?php \app\lib\LoadImageWidget::myRun($modelImage, 'image/create', 'form_upload_post_image', 'post', $modelNewPost->id?$modelNewPost->id:0 /*$modelNewPost->id*/); ?>
                    <div id="post_images" data-delurl="<?php echo Url::toRoute('image/delete'); ?>">
                        <?php if ($modelNewPost->id): ?>
                            <?php if ($modelNewPost->images) foreach($modelNewPost->images as $postImage): ?>
                                <div id="divimage<?php echo $postImage->id; ?>"><img src="<?php echo $postImage->getImageUrl('small'); ?>">
                                    <span class="delete_button" onClick="deleteImage(<?php echo $postImage->id; ?>);"><span class="delete"></span></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <a href="#" class="upload_button" onClick="$('#form_upload_post_image .file_input').trigger('click'); return false;"><b><?= \Yii::t('app', 'Add Photo')?></b></a>
                    </div>
                </div>
                        <?php } ?>

                <div class="col-sm-12">
                    <div class="postsProfil">
                        <?php  echo $this->render('/site/_posts', array('data' => $modelUser->publishPosts/*,'pagination'=>$pagination*/)); ?>
                    </div>
                </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <div class="avatar">
            <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
        </div>
    </div>
</div>
