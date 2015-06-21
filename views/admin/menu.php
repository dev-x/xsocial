<?php
use yii\helpers\Html;
?>
<script>

</script>
<div class="col-sm-12">
    <?php
        
        $class = ($this->context->getRoute() == 'admin/index')?'btn btn-default':'btn btn-primary'; 
        $class1 = ($this->context->getRoute() == 'admin/addgroup')?'btn btn-default':'btn btn-primary'; 
        $class2 = ($this->context->getRoute() == 'admin/addkafedra')?'btn btn-default':'btn btn-primary'; 
        $class3 = ($this->context->getRoute() == 'admin/addinstitute')?'btn btn-default':'btn btn-primary'; 
        
        echo ' '.HTML::a(\Yii::t('app', 'Модерація Користувачів'), array('admin/index'),array('class'=>$class));
        echo ' '.HTML::a(\Yii::t('app', 'Добавлення груп'), array('admin/addgroup'),array('class'=>$class1));
        echo ' '.HTML::a(\Yii::t('app', 'Добавлення кафедр'), array('admin/addkafedra'),array('class'=>$class2));
        echo ' '.HTML::a(\Yii::t('app', 'Добавлення факультету'), array('admin/addinstitute'),array('class'=>$class3));
?>
    </br>
</div>
