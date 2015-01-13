<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\ContactForm $model
 */
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php // if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
<!--
    <div class="alert alert-success">
        Thank you for contacting us. We will respond to you as soon as possible.
    </div>

    <?php // else: ?>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>
-->
    <div class="row wrap">
    <div style="border-bottom:1px solid #e0e0e0;" class="col-sm-12">
        <h1>Про нас</h1>
        <p style="margin-bottom:30px;">Дипломна Робота студнтів групи КН-46, Даціва Степана ІВановича і Новодарського Олександра Володимировича
        Yii (вимовляється як «Yee» або [ji:]) — це високопродуктивний веб-фреймворк, написаний на PHP, реалізує парадигму модель-вид-контролер.[1] Yii — скорочення від «Yes It Is!»
        Backbone — це JavaScript бібліотека з RESTful JSON інтерфейсом і базується на парадигмі програмування model–view–presenter (MVP). Backbone.js відомий своїми малими розмірами та прямою залежністю від бібліотеки Underscore.js. Бібліотека призначена для розробки односторінкових веб-застосунків. Розроблена Джеремі Ашкінсоном, відомим завдяки CoffeeScript.
        </p>
        <button id="contactView" class="btn btn-primary">Звязатись з адміністрацією</button><br><br><br><br><br><br>
    </div>
    
    </div>
</div>    
<div class="row wrap" style="border:0px; padding:185px; margin-top:-450px;">
        <div class="col-lg-3">
        </div>
            <div id="shadow">
            </div>
            <div style="position:relative; background-clip: padding-box; width:800px;" id="contact">
                <div style="background-color:white;" class="well">
                <h1>Звязатись з адміністратором сайту</h1>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                        <?= $form->field($model, 'name') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'subject') ?><?= $form->field($model, 'rr') ?>
                        <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                        <?=$form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'options' => ['class' => 'form-control'],
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]); ?>
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <div class="col-lg-3">
        </div>
    <?php // endif; ?>
</div>
