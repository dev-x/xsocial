<?php
use yii\helpers\Html;
?>
<script>
    
</script>
<div class="col-sm-12">
    <!--<ul style="padding:5px;" class="nav nav-tabs">
        <li>dvdvdvdvdv</li>
        <li>dvdvdvdvdv</li>
        <li>dvdvdvdvdv</li>
    </ul>-->
    <?php
        
        
        $class = ($this->context->getRoute() == 'user/show')?'btn btn-default':'btn btn-primary'; 
        $class1 = ($this->context->getRoute() == 'user/images')?'btn btn-default':'btn btn-primary'; 
        $class2 = ($this->context->getRoute() == 'user/profile')?'btn btn-default':'btn btn-primary'; 
        ?>
        <?= HTML::a('Пости', array('user/show', 'username' => $modelUser->username),array('class'=>$class)); ?>
        <?= HTML::a('Фотографії', array('user/images', 'username' => $modelUser->username),array('class'=>$class1));?>
        <?= HTML::a('Профіль', array('user/profile', 'username' => $modelUser->username),array('class'=>$class2));?>
        <!--<li class=""><?//= HTML::a('Фотографії', ['user/images', 'username' => $modelUser->username]); ?></li>
        <li class=""><?//= HTML::a('Профіль', ['user/profile', 'username' => $modelUser->username]); ?></li>-->
    
    <?php //echo ?>
    </br>
</div>