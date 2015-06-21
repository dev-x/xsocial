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
        <h1>Добавлення Кафедри</h1>
        <div class="col-sm-12 well" style='background-color:#fefeff;'>
            <?php // var_dump($newgroup);exit; ?>
            <?php //var_dump($listKafedra); ?>
            
            <?php $form = ActiveForm::begin(['id' => 'newDepartment', 'action' => '../admin/addkafedra']); ?>
                <?= $form->field($newdepartment, 'name')->textInput(['placeholder' => 'Назва кафедри'])->label(false); ?>
                <?= $form->field($newdepartment, 'slug')->textInput(['placeholder' => 'Url кафедри'])->label(false); ?>
                <?= $form->field($newdepartment, 'parent_id')->dropDownList($listKafedra)->label(false); ?>
                <?= Html::input('submit', 'submit_save',  \Yii::t('app', 'Відправити'), ['class' => 'btn-submit btn btn-primary']); ?>
            <?php ActiveForm::end(); ?>
        </div>
        
               <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <td><b>#</b></td>
                <td><b>Назва</b></td>
                <td><b>Інститут</b></td>
                <td><b>Url групи</b></td>
                <td></td>
            </tr>
            <?php foreach ($departments as $department) : ?>
                <tr>
                    <td><?php echo $department->id;?></td>
                    <td><?php echo $department->name;?></td>
                    <td>
                        <?php
                            foreach ($institutes as $institute){
                                if($institute['id'] == $department->parent_id){
                                    echo $institute['name']; 
                                }
                            }
                        ?> 
                    </td>
                    <td><?php echo $department->slug; ?></td>
                    <td><?php echo Html::a(\Yii::t('app', 'Delete'), array('admin/deletekafedra','id'=>$department->id));?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <div>
            <?php echo LinkPager::widget(['pagination'=>$pagination]); ?>
        </div>
        
    </div>
</div>