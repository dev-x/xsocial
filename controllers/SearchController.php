<?php

namespace app\controllers;
use yii\web\HttpException;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

use Yii;
use yii\helpers\BaseJson;
use yii\web\Controller;
use app\models\Post;
use app\models\Comment;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

class SearchController extends Controller
{
	
    public function actionIndex()
    {
        echo "xxxx";
    }
    
    public function actionTaxonomy($taxonomy, $keyword = null)
    {
        echo "{$taxonomy} : {$keyword}";
		switch ($taxonomy){
			case 'hashtag':
				$posts = [];
				break;
			case 'feed':
				if (Yii::$app->user->isGuest) {
					echo 'redirect login'; 
					return;
				}
				$fts = Yii::$app->user->identity->followingTo;
        
				$ids = '';
				foreach($fts as $ft){
					$ids[] = $ft->following_user_id;
				}
				
				$posts = Post::findAll(['user_id' => $ids]);
				break;
			default:
				// get from lists ... where type = $taxonomy and slug = $keyword	===>  $group_id
				// get users ids where group = $group_id   => $users_ids
				$ids = [1, 2];
				// ge
				$posts = Post::findAll(['user_id' => $ids]);
				
		}
		echo $this->render('/site/feed', [
			'posts' => $posts
		]);
    }
}
