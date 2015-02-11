<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\models\User $model
 */

?>
<div style="padding-bottom:50px;" class="row wrap">
    <h1 style="margin-left:50px;"><?= \Yii::t('app', 'Sign up')?></h1>
    <div class="site-signup">
    <?php $stat = ['male' => 'Чоловіча', 'female' =>'Жіноча']; ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">

            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'form-signup',
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
                                    <?= $form->field($model, 'group_id')->dropDownList($list) ?>
                    <div style="margin-left:150px;" class="form-group">
                        <?= Html::submitButton(\Yii::t('app', 'SignUp'), ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
