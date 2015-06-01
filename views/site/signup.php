<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\models\User $model
 */

?>
<div class="row wrap">
    <div class="col-sm-12">
        <h1><?= \Yii::t('app', 'Sign up')?></h1>
    </div>
    <div class="site-signup">
    <?php $stat = ['male' => 'Чоловіча', 'female' =>'Жіноча']; ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-lg-12">
                <?php 
                $list_a = array(0 => 'Виберіть групу');
                $list = array_merge($list_a, $list);
                $list_b = array(0 => 'Виберіть кафедру');
                $list_department = array_merge($list_b, $list_department);
                
                $form = ActiveForm::begin(['id' => 'form-signup',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-2 control-label'],
                    ],

                ]); ?>
                    <?= $form->field($model, 'username') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'first_name') ?>
                        <?= $form->field($model, 'last_name') ?>
                        <?= $form->field($model, 'stat')->RadioList($stat,['inline' =>true]); ?>
                        <?= $form->field($model, 'city_id')->dropDownList($list_city); ?>
                        <?= $form->field($model, 'role_id')->RadioList($list_role,['inline' =>true]); ?>
                        <?= $form->field($model, 'group')->dropDownList($list); ?>
                        <?= $form->field($model, 'vnz')->dropDownList($list_department); ?>
                    <div style="margin-left:150px;" class="form-group">
                        <?= Html::submitButton(\Yii::t('app', 'SignUp'), ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
