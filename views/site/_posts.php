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
                <div style="border-bottom:1px solid #e0e0e0;" class="col-sm-12">
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
                                    <li><img style="width:20px;" src="<?= $post->author->getAvatarUrl(); ?>"></li>
                                        <li style="margin-left:-8px;"><?= HTML::a($post->author->username, ['user/show', 'username' => $post->author->username]) ?></li>
                                        <li><a href=""><span class="glyphicon glyphicon-time"></span><i><?php echo $post->post_time ?></i></a></li>
                                        <li><a href=""><i class="glyphicon glyphicon-comment"></i> <?php echo $post->ccount; ?> - Коментарів </a></li><li><a href=""> 
                                        <li style="float:right" ><button type="submit" class="btn btn-default pull-right"><?php  echo Html::a("Дочитати", array('post/show', 'id'=>$post->id));  ?></button></li>
                                </ul>
                    
                </div>    
            <?php endforeach; ?>
        </div>
<div style="float:left;">
        <?php if (isset($pagination)){ echo LinkPager::widget(['pagination'=>$pagination]);} ?>
</div>