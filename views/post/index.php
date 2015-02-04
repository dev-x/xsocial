<?php
$this->title = 'Блоги';
?>
<div style="background-color:#fefeff;" class="row wrap">
<!--<div class="col-sm-12">
    <img style="width:100%;height:240px;border-radius:2%;" src="/nxblog/web/content/123.jpg">
</div> -->    
    <div class="col-sm-9">
        <?php echo $this->render('/site/_posts', array('data' => $data, 'pagination' => $pagination)); ?>
    </div>
    <div class="col-sm-3">
        <?php echo $this->render('/user/_sidebar'); ?>
    </div>
</div>