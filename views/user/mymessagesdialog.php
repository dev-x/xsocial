<?php
    use yii\helpers\Html;
    use yii\widgets\LinkPager;
    use yii\widgets\ActiveForm;
?>
<script type="text/template" id="template-messages-element">    
    <div class="well comment" id="<%= id %>" style='padding:10px; margin-bottom:10px;'>
         <div class="commentFloat"><img class="author-image" src="/<%= avatar %>"></div>
         <text class='text-primary commentText'>
             <text class='text-info commentTextTime'><%= created %></text>
         </text>
         <div class="commentFloat">
             <button class='btn-primary deleteButton' id='<%= id %>' data-action='<%= id %>' > Видалити</button>
         </div>
         <div class="btn-default"><%= content %></div>
    </div>
</script>

<div class="row wrap">
    <div class="col-sm-9 col-xs-12">
        <?php  echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
        <div class="col-sm-12" style='margin-bottom:20px;'>
            <h1>Повідомлення з <?= $modelFriend->username;?></h1>
            <?php $form = ActiveForm::begin(['id' => 'MessageNew', 'action' => Yii::$app->homeUrl.'messages/create']); ?>
            <input type="hidden" name="Messages[friend_id]" value="<?= $modelFriend->id; ?>">
            <input type="hidden" name="Messages[user_id]" value="<?= $modelUser->id; ?>">
                <?= $form->field($modelNewMessage, 'content')->textArea(['rows' => 1 , 'placeholder' => \Yii::t('app', 'Text of new messages'), 'id'=>'newComment']); ?>
                <?= Html::input('submit', 'submit_save',  \Yii::t('app', 'Відправити'), ['class' => 'btn-submit btn btn-primary']); ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-sm-12 messageList">
            <?php
                foreach($messages as $message){
                    $user_data = Yii::$app->user->identity->findIdentity($message['user_id']);?>
                        <div class="well comment mymessagesfriend" id="<?= $message['id'] ?>" style='padding:10px; margin-bottom:10px;'>
                             <div class="commentFloat"><img class="author-image" src="/<?= $user_data['avatar'];?>"></div>
                             <text class='text-primary commentText'>
                                 <text class='text-info commentTextTime'> <?= $message['created'] ?></text>
                             </text>
                             <div class="commentFloat">
                                 <button class='btn-primary deleteButton' id='<?= $message['id']; ?>' data-action='<?= $message['id'] ?>' > Видалити</button>
                             </div>
                             <div class="btn-default"> <?= $message['content']."</br>"; ?></div>
                        </div>
            <?php 
            }
            ?>
        </div>
        <div class="col-sm-12">
            <?php if (isset($pagination)){ echo LinkPager::widget(['pagination'=>$pagination]);} ?>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <div>
        <?php  echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
        </div>
    </div>
</div>
