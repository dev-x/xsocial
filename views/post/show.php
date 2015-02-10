<?php
/**
 * @var yii\base\View $this
 */
$this->title = $post->title;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style>
    .author-image {
        border-radius: 24px;
        box-shadow: 0 3px 5px #8D8D8D;
        height: 48px;
        width: 48px;
    }
</style>
<script type="text/template" id="template-comment-element">
<div style="background-color:#fff" class="well" id="createdcomment">
    <div style="float:right"><img class="author-image" src='<%= avatarurl %>'></div>
    <text style='font-size:18px' class='text-primary'><a href='<%= userurl %>'><%= username %></a>
                <text class='text-info' style='font-size:12px'> | <%= datetime %></text></text>
                <div class="btn-default"><%= content %></br></div></div>
</script>

<div class="row wrap">
    <div style="margin-top:3px;min-height:550px;" class="col-sm-9">        
        <h3 style="text-align:center;font-size:40px; color: black;"><font style="color:#008B66;"><?php echo $post->title; ?></font></h3>    
        <?php if(Yii::$app->session->hasFlash('PostEdit')): ?>
            <div id="zberezhenoq" class="breadcrumb">
                <p style="font-size:18px;" id="zberezheno" class="active"><?= \Yii::t('app', 'Saved')?></p>
            </div>
        <?php endif; ?>
            <div  class="row" style="padding:12px 0px 10px 10px;margin-top:-20px;display:block;" >         
                            
                                    <?php if ($post->images) foreach($post->images as $postImage):  ?>
                                    <?php //echo $postImage->getImageUrl('small'); ?>
                                            <a href="<?php echo $postImage->getImageUrl('medium');?>" rel="prettyPhoto[<?php echo $post->id;?>]"><img align="center" style="float:left;margin: 7px 7px 7px 0;border:5px double #ddd; width:49%;" src="<?php echo $postImage->getImageUrl('medium');?>"></a>
                                    <?php endforeach; ?>

                    <?php echo $post->content; ?>
            </div>
<<<<<<< HEAD
        
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
            <div style="padding:10px;margin-top:60px; background-color:#F7FFFE;" class="well bs-component">
                <i style="float:right;color:#008B66;"><?php echo $post->post_time; ?></i><span style="color:#008B66;float:right;" class="glyphicon glyphicon-time"></span>
                <a href="" class="like_button" id='<?= $post->id ?>' data-id='<?= $post->id ?>' data-type='Post' data-action="<?= $action;?>"><i id="likes_view<?= $post->id; ?>" class="<?= $class;?>">-<?php echo $post->likes; ?></i></a>
                
            </div>
            <div style="padding:10px;background-color:#F7FFFE;" class="well bs-component">
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
        <div id="commetslist">
            <?php foreach ($comments as $comment) : ?>
                        <div style="background-color:#fff" class="well" id="<?= $comment->id ?>">
                            <div style="float:right"><img class="author-image" src="<?= $comment->author->getAvatarUrl(); ?>"></div>
                                <?php echo "<text style='font-size:18px' class='text-primary'>
                                ".HTML::a($comment->author->username, ['user/show', 'username' => $comment->author->username])."
                                <text class='text-info' style='font-size:12px'> | ".$comment->created."</text></text>";?>
                                <text style='float:right'>
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
    <div class="col-sm-3">
                <?php echo $this->render('/user/_sidebar', array('author' => $post->author)); ?>
    </div>
</div>
