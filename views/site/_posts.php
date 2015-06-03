<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>
    <?php if(Yii::$app->session->hasFlash('PostDeleted')): ?>
        <div class="breadcrumb">
            <p style="font-size:18px;" class="active"><?=\Yii::t('app', 'Deleted')?></p>
        </div>
    <?php endif; ?>
        <div id="postsl" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if($data != null) foreach ($data as $post) : ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftBlock" id="parent_info" >
                        <div class="col-sm-12">
                            <ul class="list-inline">
                                <img src="<?= $post->author->getAvatarUrl(); ?>" style='width: 40px'>
                                <li><p class="usernameOnPost"><?= HTML::a($post->author->username, ['user/show', 'username' => $post->author->username]) ?></p></li>
                                <li style='margin-left:20%;'><p class="postTitle"><?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></p></li>
                                <li style='float:right;'><span class="glyphicon glyphicon-time"></span><?php echo $post->post_time ?></li>
                            </ul>
                        </div>
                        <div class='col-sm-1'>
                        </div>
                        <div class="col-sm-11">
                        </div>
                            <!--<div><?php
                                //if (Yii::$app->user->id === $post->user_id){
                                    //echo Html::a('Update | ',array('post/edit','id'=>$post->id));} 
                            ?><?php
                                //if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $post->user_id)){
                                    //echo Html::a('Delete',array('post/delete','id'=>$post->id));} 
                            ?></div> -->
                        
                        <div class="col-sm-12">
                            <div class="conte">
                                <?= \app\lib\Str::highlightHashTags($post->content); ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="post_images" >
                                    <?php if ($post->images) foreach($post->images as $postImage): ?>
                                        <!--<img  src="<?php /* echo $postImage->getImageUrl('small');*/ ?>"> -->
                                    <?php endforeach; ?>
                              <?php if ($post->images){
                                        $qwert = count($post->images);
                                        if($qwert){ ?>
                                            <span align="center" class="imgPicture">
                                                <a href="<?php echo $postImage->getImageUrl('medium'); ?>" rel="prettyPhoto[<?php echo $post->id; ?>]"><img  src="<?php echo $postImage->getImageUrl('medium'); ?>"></a>
                                            </span>
                                        <?php } 
                                    } ?>
                            </div>
                        </div>
                        <ul class="list-inline">
                                <li class="postFloatRight"><a href=""><i class="glyphicon glyphicon-comment"></i> <?= \Yii::t('app', '{n, plural, =0{ no comments} =1{one comment} other{# comments}}!', ['n' => $post->ccount]) ?> </a></li> 
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
                                <li class="postFloatRight"><a href="" class="like_button" id='<?= $post->id ?>' data-id='<?= $post->id ?>' data-type='Post' data-action="<?= $action;?>"><i id="likes_view<?= $post->id; ?>" class="<?= $class;?> postLike"><text id="like_count<?= $post->id; ?>" class="like_count"><?php echo $post->like_count; ?></text></i></a></li>
                              <!--  <li style="float:right" ><?php //  echo Html::a(\Yii::t('app', 'Read to the end'), ['post/show', 'id'=>$post->id],['class' => 'btn btn-default pull-right']);  ?></li> -->
                        </ul>
                    </div>    
                </div>   
            <br>
            <?php endforeach; 
                if($data == null){
                    echo '<h1>Постів незнайдено</h1>';
                }
            ?>
        </div>
        <div class="postFloatLeft">
                <?php if (isset($pagination)){ echo LinkPager::widget(['pagination'=>$pagination]);} ?>
        </div>