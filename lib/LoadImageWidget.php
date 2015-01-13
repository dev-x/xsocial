<?php

namespace app\lib;

use yii\base\Widget;
use yii\widgets\ActiveForm;

class LoadImageWidget extends Widget
{
    static private $started = false;
    public static function myRun($model, $action, $html_form_id, $parent_type, $parent_id)
    {
        //if (self::$started) return;
        //self::$started = true;
        echo "<div>";
        $form = ActiveForm::begin([
            'action' => \Yii::$app->homeUrl.$action,
            'id' => $html_form_id,
             'options' => ['enctype' => 'multipart/form-data', 'class' => 'upload_image']
            ]);
        echo "<input type=hidden name=\"Image[parent_type]\" value=\"{$parent_type}\" id=\"image-parent_type\" >";
        echo "<input type=hidden name=\"Image[parent_id]\" value=\"{$parent_id}\" id=\"image-parent_id\" >";
        echo $form->field($model, 'file_name')->fileInput(['class' => 'file_input']); /*ActiveForm::fileInput();*/
        //echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);
        ActiveForm::end();
        echo "</div>";
        //Yii::$app->getView()
        //$view = $this->getView();
        //$view->registerJs();
    }
}