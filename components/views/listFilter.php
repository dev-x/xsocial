<?php
    use yii\helpers\Html;
?>
        <h3 align="center">фільтрація новин</h3>
        <!--<h3 style="color:#008B66;font-style: italic;"><?php //= \Yii::t('app',$name);?></h3> -->
        <?php //foreach ($listfilter as $list) : ?>
            
                <div class="col-sm-12" style='padding-bottom:4px;'>
                    <?php  echo Html::a('Новини моєї групи', ['search/group'],['class' => 'btn-submit btn btn-primary pro100']);  ?>
                </div>
                <div class="col-sm-12" style='padding-bottom:4px;'>
                    <?php  echo Html::a('Новини моєї кафедри', ['search/department'],['class' => 'btn-submit btn btn-primary pro100']);  ?>
                </div>
                <div class="col-sm-12">
                    <?php  echo Html::a('Новини мого інституту', ['search/institute'],['class' => 'btn-submit btn btn-primary pro100']);  ?>
                </div>    
        <?php //endforeach; ?>