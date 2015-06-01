<?php
/**
 * @var yii\base\View $this
 */
$this->title = $post->title;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<script type="text/template" id="template-comment-element">    
    <div class="well comment" id="createdcomment">
        <div class="commentFloat"><img class="author-image" src="<%= avatarurl %>"></div>
            <text class='text-primary commentText'>
                <a href='<%= userurl %>'><%= username %></a>
                <text class='text-info commentTextTime'><%= datetime %></text>
            </text>
            <text class="commentFloat">
                
            </text>
        <div class="btn-default"> <%= content %></div>
    </div>       
</script>

<div class="row wrap">
    <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 ShowPostComment">
        <div class="row postShow">
        <div class="col-sm-12">
            <p class="postShowTitle"><?php echo $post->title; ?></p>    
            <?php if(Yii::$app->session->hasFlash('PostEdit')): ?>
                <div id="zberezhenoq" class="breadcrumb">
                    <p style="font-size:18px;" id="zberezheno" class="active"><?= \Yii::t('app', 'Saved')?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 postShowImage">         
                <?php if ($post->images) foreach($post->images as $postImage):  ?>
                <?php //echo $postImage->getImageUrl('small'); ?>
                        <a href="<?php echo $postImage->getImageUrl('medium');?>" rel="prettyPhoto[<?php echo $post->id;?>]"><img align="center" src="<?php echo $postImage->getImageUrl('medium');?>"></a>
                <?php endforeach; ?>
        </div>
        <div class="col-sm-12 postShowContent">
                <?php //echo $post->content; ?>
            <?php
            $str = preg_replace_callback("/#([\S]+)/", 'func', $post->content);
            function func($zamina){
                    //print_r($qwer);exit;
                    return "<a href='../search/hashtag/".$zamina[1]."'>#".$zamina[1]."</a>";
            }
            echo $str;
            ?>
        </div>
        <div class="col-sm-12">
            <?php
            if (!Yii::$app->user->isGuest){
                if (Yii::$app->user->identity->isLikes($post->id,'post')){
                    $action = 'likeoff';
                    $class = 'glyphicon glyphicon-heart';
                }else{
                    $action = 'likeon';
                    $class = 'glyphicon glyphicon-heart-empty';
                }
            }else{
                $action = 'none';
                $class = 'glyphicon glyphicon-heart-empty';
            }
            ?>
            <p class="text-right"><?php
                       if (Yii::$app->user->id == $post->user_id){
                            echo Html::a(\Yii::t('app', 'Update'), array('post/eddit', 'id'=>$post->id));
                        } 
                ?>
                <?php
                        if ((Yii::$app->user->id == '1') || (Yii::$app->user->id === $post->user_id)){
                            echo Html::a(\Yii::t('app', 'Delete'), array('post/delete', 'id'=>$post->id));
                        } 
                ?>
            </p>
        </div>
        <div class="col-sm-12">
            <div class="well bs-component PostShowInfoPanel">
                <i class='PostShowTime1'><?php echo $post->post_time; ?></i><span class="glyphicon glyphicon-time PostShowTime2"></span>
                <a href="" class="like_button" id='<?= $post->id ?>' data-id='<?= $post->id ?>' data-type='Post' data-action="<?= $action;?>">
                    <i id="likes_view<?= $post->id; ?>" class="<?= $class;?>">
                        <text id="like_count<?= $post->id; ?>" class="like_count"><?php echo $post->like_count; ?></text>
                    </i>
                </a>   
            </div>
        </div>
        </div>
        <div class="row comment">
            <div class="col-sm-12">
                <div class="well bs-component PostShowCommentPanel">
                    <?php if (Yii::$app->user->isGuest) { ?>
                            <?php echo Html::a (\Yii::t('app', 'Need sign in to comment'), 'site/login'); }
                                                elseif (Yii::$app->user->identity->dozvil != 1) { ?>
                        <h3><?= \Yii::t('app', 'Sorry, but now your profile is inactive. You can simply wait or contact administrator')?></h3>
                                                <?php } else {?>
                    <?php $form = ActiveForm::begin(['id' => 'CommentNew', 'action' => Yii::$app->homeUrl.'comment/create' /*,'enableClientValidation'=>false*/]); ?>
                         <input type="hidden" name="Comment[parent_id]" value="<?= $post->id; ?>">
                    <?=  $form->field($modelNewComment, 'content')->textArea(['rows' => 1,  'placeholder' => \Yii::t('app', 'Your comment'), 'id'=>'newComment']) ?>
                    <?= Html::submitButton(\Yii::t('app', 'Send'), ['class' => 'btn btn-primary']); ?>
                    <?php ActiveForm::end();}?>
                </div>
            </div>
            <div class="col-sm-12">
                <div id="commetslist">
                    <?php foreach ($comments as $comment) : ?>
                                <div class="well comment" id="<?= $comment->id ?>">
                                    <div class="commentFloat"><img class="author-image" src="<?= $comment->author->getAvatarUrl(); ?>"></div>
                                        <text class='text-primary commentText'>
                                            <?php echo HTML::a($comment->author->username, ['user/show', 'username' => $comment->author->username]);?>
                                            <text class='text-info commentTextTime'> <?php echo $comment->created; ?></text>
                                        </text>
                                        <text class="commentFloat">
                                            <?php
                                                if ((Yii::$app->user->id == '1' ) || (Yii::$app->user->id === $comment->user_id)){
                                                        echo Html::a(\Yii::t('app', 'Delete'), array('comment/delete','id'=>$comment->id,'idP'=>$post->id));
                                                }
                                            ?>
                                        </text>
                                    <div class="btn-default"> <?php echo $comment->content."</br>"; ?></div>
                                </div>
                    <?php endforeach; ?>
                </div>
            </div>    
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
        <div class="col-sm-12">
                <?php echo $this->render('/user/_sidebar', array('author' => $post->author)); ?>
        </div>
    </div>
</div>
