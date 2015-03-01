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
use app\models\Lists;
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
       // echo "{$taxonomy} : {$keyword}";
         $model = '';
		switch ($taxonomy){
			case 'hashtag':
				$posts = Post::find()->where(['like','content', '#'.$keyword]);
                                $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);
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
				
                                $posts = Post::find()->where(['user_id' => $ids]);
                                $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);
                                
				break;
                        case 'post_type':
                        case 'post_category':
                                    $lists = Lists::findOne(array('list_type' => $taxonomy, 'slug' => $keyword));
                                    $posts = Post::find()->where([$taxonomy => $lists->id]);
                                    $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);
                            break;
                        case 'group':
                        case 'xxx':
                                    $lists = Lists::findOne(array('list_type' => $taxonomy, 'slug' => $keyword));
                                    if($lists){
                                        $model_users = User::find()->where([$taxonomy => $lists->id])->all();

                                        $user_id = '';
                                        foreach($model_users as $user){
                                            $user_id[] = $user->id;
                                        }
                                        $posts = Post::find()->where(['user_id' => $user_id]);
                                        $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);

                                    }else{
                                        $posts = null;
                                    }
		} echo $this->render('/site/feed', [
                            'posts' => $model->getModels(),
                            'pagination' => $model->pagination,
                            'count' => $model->pagination->totalCount,
                    ]);
    }
}
