<?php
use app\components\LatestNews;
use app\components\ListFilter;

    $this->title = 'Блоги';
?>
<div class="row wrap">
    <div class="col-sm-9 col-xs-12">        
        <?php echo $this->render('/site/_posts', array('data' => $posts, 'pagination' => $pagination)); ?>
    </div>
    <div class="col-sm-3 col-xs-12">
        <?= ListFilter::widget(['type' => 'group', 'name' => 'group']) ?>
        <?= ListFilter::widget(['type' => 'post_type', 'name' => 'postType']) ?>
        <?= ListFilter::widget(['type' => 'post_category', 'name' => 'postCategory']) ?>
    </div>
</div>