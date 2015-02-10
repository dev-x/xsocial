<?php
/**
 * @var yii\base\View $this
 * @var app\modules\user $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(array('options' => array('class' => 'form-vertical')));
    echo $form->field($model, 'first_name')->textInput(array());
    echo $form->field($model, 'last_name')->textInput(array());
    echo $form->field($model, 'email')->textInput(array());
    echo $form->field($model, 'city')->textInput(array());
    echo $form->field($model, 'vnz')->textInput(array());
    echo $form->field($model, 'group_id')->textInput(array());
    echo $form->field($model, 'mobil')->textInput(array());
    echo $form->field($model, 'skype')->textInput(array());
    echo $form->field($model, 'myCredo')->textInput(array());
    echo $form->field($model, 'myInfo')->textArea(array('rows' => 9,'cols'=>181));
?>

<div class="form-actions">
    <?php echo Html::submitButton($model->isNewRecord ? \Yii::t('app', 'Save') : \Yii::t('app', 'Update'), array('class' => 'btn btn-primary')); ?>
</div>

<?php ActiveForm::end(); ?>
