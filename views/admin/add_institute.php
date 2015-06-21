<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
?>
<div class="row wrap" style="padding:20px; padding-top:0px;">
    <h1>Панель адміністрування</h1> 
    <div class='col-sm-12'>
        <?php echo $this->render('menu'); ?>    
    </div>
    <div class='col-sm-12'>
        <h1>Добавлення Інституту</h1>
        <div class="col-sm-12 well" style='background-color:#fefeff;'>
            <?php // var_dump($newgroup);exit; ?>
            <?php //var_dump($listKafedra);exit; ?>
            
            <?php $form = ActiveForm::begin(['id' => 'newInstitute', 'action' => '../admin/addinstitute']); ?>
                <?= $form->field($newinstitute, 'name')->textInput(['placeholder' => 'Назва Факультету'])->label(false); ?>
                <?= $form->field($newinstitute, 'slug')->textInput(['placeholder' => 'Url факультету'])->label(false); ?>
                <?php //= $form->field($newinstitute, 'parent_id')->dropDownList($listKafedra); ?>
                <?= Html::input('submit', 'submit_save',  \Yii::t('app', 'Відправити'), ['class' => 'btn-submit btn btn-primary']); ?>
            <?php ActiveForm::end(); ?>
        </div>
        
               <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <td><b>#</b></td>
                <td><b>Назва</b></td>
                <td><b>Url інституту</b></td>
                <td></td>
            </tr>
            <?php foreach ($modelInstitute as $institutess) : ?>
                <tr>
                    <td><?php echo $institutess->id;?></td>
                    <td><?php echo $institutess->name;?></td>
                    <td><?php echo $institutess->slug; ?></td>
                    <td><?php echo Html::a(\Yii::t('app', 'Delete'), array('admin/deleteinstitute','id'=>$institutess->id));?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <div>
            <?php echo LinkPager::widget(['pagination'=>$pagination]); ?>
        </div>
        
    </div>
</div>