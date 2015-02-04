<?php
    use yii\helpers\Html;
?>
        <h3 style="color:#008B66;font-style: italic;"><?= \Yii::t('app','Latest Post');?></h3>
        <?php foreach ($latestnews as $post) : ?>
            <div class="panel panel-default">
                <div style="background-color:#00A87B;" class="panel-heading">
                <a class="podskazka" href="#" style="padding:2px;margin-left:10px; font-size:18px;color:#fff;font-style: italic;"><?= mb_substr($post->title, 0, 20, "UTF-8")."..."; ?><span><?= $post->title; ?></span></a>
                </div>
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
        <?php endforeach; ?>