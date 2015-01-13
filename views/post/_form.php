<?    
/**
 * @var yii\base\View $this
 * @var app\modules\blogs\models\Blog $model
 */
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(array('options' => array('class' => 'form-vertical')));
echo $form->field($model, 'title')->textInput(array());
echo $form->field($model, 'content')->textArea(array('rows' => 9,'cols'=>181));
?>

<div class="form-actions">
	<?     echo Html::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary')); ?>
</div>

<?     ActiveForm::end(); ?>