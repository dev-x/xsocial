<?php
/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\modules\blogs\Blog $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = \Yii::t('app', 'Edit Blog');
?>
<div style="padding:20px;" class="row wrap">
	<div class="page-header">
		<h1><?= Html::encode($this->title); ?></h1>
	</div>
	<?= $this->render('_form', array('model' => $model)) ?>
</div>
