<?php
    use yii\helpers\Html;
    use yii\widgets\LinkPager;
?>
<div class="row wrap">
    <div class="col-sm-9">
        <?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
        <div class="row" style="margin-top:50px">
        <?php foreach ($followUser as $user) : ?>
            <div style="margin-bottom:10px;border-bottom:1px solid #e0e0e0;padding-bottom: 10px" class="col-sm-12" id='user-info' data-id='<?= $user->id; ?>'>
                <div class="col-sm-3">
                    <img  src="/<?= $user->avatar;?>" style="border-radius: 4px; width:200px; box-shadow:0px 0px 5px #9d9d9d;">
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <?= HTML::a($user->first_name." ".$user->last_name, ['user/show', 'username' => $user->username]) ?>
                    </div>
                    <div class="col-sm-12">
                        <?= $user->myCredo;?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <?php if (!Yii::$app->user->isGuest && ($user->id != Yii::$app->user->id)){
                    if (Yii::$app->user->identity->isFollowingTo($user->id)){
                        $but_action = 'unfollow';
                        $but_title = 'Відписатися';
                    } else {
                        $but_action = 'follow';
                        $but_title = 'Підписатися';
                    }    
            ?>
                <a href="#" class='btn btn-default follow-button' data-action='<?= $but_action; ?>' ><?= $but_title; ?></a>
            <?php } ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="avatar">
        <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
    </div>
</div>
<div id="shadow"></div>
<div id="photo"></div>
