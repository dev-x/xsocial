<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */

?>
<div style="padding-left:20px; padding-bottom:40px;" class="row wrap">
    <div class="site-login">
        <h1>Вхід</h1>

        <p>Заповніть всі поля для входу:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
        <div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
    </div>
    <div style="margin-top:-34px;" class="col-lg-offset-2 col-lg-11">
        <p><a class="btn btn-primary" href="<?=  Url::toRoute('site/signup') ?>">Реєстрація</a></p>
    </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>