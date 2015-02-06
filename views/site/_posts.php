<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>
<script type="text/javascript">

</script>
        <?php if(Yii::$app->session->hasFlash('PostDeleted')): ?>
            <div class="breadcrumb">
                <p style="font-size:18px;" class="active">Видалено</p>
            </div>
            
        <?php endif; ?>
        <div id="postsl">
            <?php foreach ($data as $post) : ?>
                <div class="row">
                    <div style="margin-top:20px;" class="col-sm-2">
                        <div class="col-sm-10">
                            <img style="width:65px;border-radius: 2px;box-shadow:0px 0px 5px #9d9d9d;" src="<?= $post->author->getAvatarUrl(); ?>">                            
                        </div>
                        <div class="col-sm-2" style="padding-left:0px;margin-top:30px;">
                            <div class="trec"></div>
                        </div>
                        <div class="col-sm-12">
                            <?= HTML::a($post->author->username, ['user/show', 'username' => $post->author->username]) ?>    
                        </div>
                    </div>
                    <div class="col-sm-10" id="parent_info" >
                        <h2 style="margin-left:10px;"><?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></h2>
                                <!--    <div><?php
                                        //if (Yii::$app->user->id === $post->user_id){
                                            //echo Html::a('Update | ',array('post/edit','id'=>$post->id));} 
                                    ?><?php
                                        //if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $post->user_id)){
                                            //echo Html::a('Delete',array('post/delete','id'=>$post->id));} 
                                    ?></div> -->
                        <div class="conte"><?= mb_substr($post->content, 0, 300, "UTF-8")."..."; ?></div>
                        <div align="center" style="margin-bottom:10px;" class="post_images" >
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

                                    <ul class="list-inline">
                                            <li><a href=""><span class="glyphicon glyphicon-time"></span><i><?php echo $post->post_time ?></i></a></li>
                                            <li><a href=""><i class="glyphicon glyphicon-comment"></i> <?php echo $post->ccount; ?> - Коментарів </a></li> 
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
                                            <li><a href="" class="like_button" id='<?= $post->id ?>' data-id='<?= $post->id ?>' data-type='Post' data-action="<?= $action;?>"><i id="likes_view<?= $post->id; ?>" class="<?= $class;?>">-<?php echo $post->like_count; ?></i></a></li>

                                            <li style="float:right" ><?php  echo Html::a("Дочитати", ['post/show', 'id'=>$post->id],['class' => 'btn btn-default pull-right']);  ?></li>
                                    </ul>

                    </div>    
                </div>    
            <?php endforeach; ?>
        </div>
<div style="float:left;">
        <?php if (isset($pagination)){ echo LinkPager::widget(['pagination'=>$pagination]);} ?>
</div>