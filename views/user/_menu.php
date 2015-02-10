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
        if(Yii::$app->user->identity->id == $modelUser->id){
            $followerPage = "My followers";
        }else{
            $followerPage = $modelUser->username." Followers";
        }
        
        $class = ($this->context->getRoute() == 'user/show')?'btn btn-default':'btn btn-primary'; 
        $class1 = ($this->context->getRoute() == 'user/images')?'btn btn-default':'btn btn-primary'; 
        $class2 = ($this->context->getRoute() == 'user/profile')?'btn btn-default':'btn btn-primary'; 
        $class3 = ($this->context->getRoute() == 'user/myfollows')?'btn btn-default':'btn btn-primary'; 
        $class4 = ($this->context->getRoute() == 'user/mylikes')?'btn btn-default':'btn btn-primary'; 
        ?>
        <?= HTML::a(\Yii::t('app', 'Posts'), array('user/show', 'username' => $modelUser->username),array('class'=>$class)); ?>
        <?= HTML::a(\Yii::t('app', 'Photos'), array('user/images', 'username' => $modelUser->username),array('class'=>$class1));?>
        <?= HTML::a(\Yii::t('app', 'Profile'), array('user/profile', 'username' => $modelUser->username),array('class'=>$class2));?>
        <?= HTML::a(\Yii::t('app',$followerPage), array('user/myfollows', 'username' => $modelUser->username),array('class'=>$class3));?>
        <?php if(Yii::$app->user->identity->id == $modelUser->id){
           echo HTML::a(\Yii::t('app',"my likes"), array('user/mylikes', 'username' => $modelUser->username),array('class'=>$class4));
        } ?>
        <!--<li class=""><?//= HTML::a('Фотографії', ['user/images', 'username' => $modelUser->username]); ?></li>
        <li class=""><?//= HTML::a('Профіль', ['user/profile', 'username' => $modelUser->username]); ?></li>-->

    <?php //echo ?>
    </br>
</div>
