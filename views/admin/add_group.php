<?php
    use yii\helpers\Html;
    use yii\widgets\LinkPager;
    use yii\widgets\ActiveForm;
?>
<div class="row wrap" style="padding:20px;padding-top:0px;">
    <h1>Панель адміністрування</h1> 
    <div class='col-sm-12'>
        <?php echo $this->render('menu'); ?>    
    </div>
    <div class='col-sm-12'>
        <h1>Добавлення груп</h1>
        <div class="col-sm-12 well" style='background-color:#fefeff;'>
            <?php // var_dump($newgroup);exit; ?>
            <?php //var_dump($modelKafedra); ?>
            
            <?php $form = ActiveForm::begin(['id' => 'newGroup', 'action' => '../admin/addgroup']); ?>
                <?= $form->field($newgroup, 'name')->textInput(['placeholder' => 'Назва групи'])->label(false); ?>
                <?= $form->field($newgroup, 'slug')->textInput(['placeholder' => 'Url групи'])->label(false); ?>
                <?= $form->field($newgroup, 'parent_id')->dropDownList($listKafedra)->label(false); ?>
                <?= Html::input('submit', 'submit_save',  \Yii::t('app', 'Відправити'), ['class' => 'btn-submit btn btn-primary']); ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-sm-12" style='margin-top:15px;'>
        <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <td><b>#</b></td>
                <td><b>Назва</b></td>
                <td><b>Кафедра</b></td>
                <td><b>Url групи</b></td>
                <td></td>
            </tr>
            <?php foreach ($groups as $group) : ?>
                <tr>
                    <td><?php echo $group->id;?></td>
                    <td><?php echo $group->name;?></td>
                    <td>
                        <?php
                            foreach ($modelKafedra as $kafedra){
                                if($kafedra['id'] == $group->parent_id){
                                    echo $kafedra['name']; 
                                }
                            }
                        ?> 
                    </td>
                    <td><?php echo $group->slug; ?></td>
                    <td><?php echo Html::a(\Yii::t('app', 'Delete'), array('admin/deletegroup','id'=>$group->id));?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <div>
            <?php  echo LinkPager::widget(['pagination'=>$pagination]); ?>
        </div>
        </div>
    </div>
</div>