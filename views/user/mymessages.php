<?php
    use yii\helpers\Html;
    use yii\widgets\LinkPager;
?>
<div class="row wrap">
    <div class="col-sm-9 col-xs-12">
        <?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
        <div class="col-sm-12 followerspage">
        <h1>Messages</h1>
            <?php 
            //var_dump();
                foreach ($mymessages as $message){ ?>
                    <?php $user_data = Yii::$app->user->identity->findIdentity($message['friend_id']);?>
                    <div class='col-sm-12 mymessages' data-action='<?= $user_data['username']?>' style='padding-bottom:10px;'> 
                        <div class='col-sm-12 friendUsername' style='padding:0px;' >
                            <div class='col-sm-9'>
                                <?= HTML::a($user_data['first_name']." ".$user_data['last_name'], ['user/show', 'username' => $user_data['username']]); ?>
                            </div>
                            <div class='col-sm-3'>
                                <?= $message['created']; ?>
                            </div>    
                        </div>
                        <div class='col-sm-12'>    
                            <div class='col-sm-3'>
                                <img class="author_image_message" src="/<?= $user_data['avatar'];?>">
                            </div>
                            <div class='col-sm-9'>
                                <?= $message['content'];?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <div>
        <?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
        </div>
    </div>
</div>
