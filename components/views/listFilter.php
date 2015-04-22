<?php
    use yii\helpers\Html;
?>
        <h3 style="color:#008B66;font-style: italic;"><?= \Yii::t('app',$name);?></h3>
        <?php foreach ($listfilter as $list) : ?>
                <div class="col-sm-12">
                    <?php  echo Html::a($list->name, array('search/'.$list->list_type.'/'.$list->slug));  ?>
                </div>
        <?php endforeach; ?>