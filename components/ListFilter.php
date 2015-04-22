<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\Lists;
use app\components\views;

class ListFilter extends Widget{
    public $type;
    public $result;
    public $name;

    public function init(){
            parent::init();

            $list = Lists::find()->where(['list_type' => $this->type])->all();
            $this->result = $list;
    }

    public function run(){
            return $this->render('listFilter',['listfilter' => $this->result, 'name' => $this->name]);
    }
}
?>
                
                            
                        
            