<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\Post;
use app\components\views;

class LatestNews extends Widget{
	public $order;
	public $limit;
	public $result;
	
	public function init(){
		parent::init();
                $this->order = ($this->order === null ? `ASC` : ($this->order != `ASC` ? `DESC` : `ASC`));
                $this->limit = ($this->limit === null ? '3' : (int)$this->limit);
                
                $post = Post::find()->orderBy($this->order)->limit($this->limit)->all();
                $this->result = $post;
	}
	
	public function run(){
		return $this->render('latestNews',['latestnews' => $this->result]);
	}
}
?>
                
                            
                        
            