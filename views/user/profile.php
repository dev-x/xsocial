<?php
    use yii\helpers\Html;
?>
<div class="row wrap">
        <div class="col-sm-9 col-xs-12" style='padding-bottom:30px'>
        <?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
            <div class="page-header clearfix">
                <div style="font-color:green;" class="col-sm-8"><p style="font-size:18px;"><?php echo HTML::a(\Yii::t('app', 'Main info'));?></p></div>
                <div class="col-sm-4">
                    <?php
                        if (Yii::$app->user->id === $modelUser->id){
                            echo HTML::a(\Yii::t('app', 'Update'),array('edit','id'=>$modelUser->id),['class' => 'btn btn-default']);
                            echo " | ";
                            echo HTML::a(\Yii::t('app', 'Add VK Profile'),'http://oauth.vk.com/authorize?client_id=4190651&redirect_uri='.\Yii::$app->getUrlManager()->createAbsoluteUrl('site/addvk').'&scope=offline&display=page&response_type=code');
                        }
                        ?>
                </div>
            </div>
        <div class="col-sm-12">
            <table class="table table-striped">
                <tr>
                    <td colspan='2'><h3><b><?= $modelUser->first_name; ?> <?= $modelUser->last_name; ?><b></h3></td>
                </tr>
                <tr>
                    <td><b>Телефон</b></td>
                    <td><?php if($modelUser->mobil != 0){ echo $modelUser->mobil; }else{}; ?></td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td><?php if($modelUser->email != null){ echo $modelUser->email; } ?></td>
                </tr>
                <tr>
                    <td><b>Адреса</b></td>
                    <td><?php if($modelUser->city_id != null){ echo $modelUser->city_id; } ?></td>
                </tr>
                <tr>
                    <td><b>Група</b></td>
                    <td><?php if($modelUser->group != null){ echo $modelUser->group; } ?></td>
                </tr>
                <tr>
                    <td><b>Дата нарождення</b></td>
                    <td><?php if($modelUser->birthday != 0000-00-00){ echo $modelUser->birthday; } ?></td>
                </tr>
                <tr>
                    <td><b>Skype</b></td>
                    <td><?php if($modelUser->skype != null){ echo $modelUser->skype; } ?></td>
                </tr>
                <tr>
                    <td><b>Життєве кредо</b></td>
                    <td><?php if($modelUser->myCredo != null){ echo $modelUser->myCredo; } ?></td>
                </tr>
                <tr>
                    <td><b>Інформація про мене</b></td>
                    <td><?php if($modelUser->myInfo != null){ echo $modelUser->myInfo; } ?></td>
                </tr>
                </table>
            
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <div class="avatar">
            <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
        </div>
    </div>
</div>
