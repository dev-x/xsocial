<?php

namespace app\controllers;

use Yii;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Image;
use app\models\User;
use app\models\Post;

class ImageController extends Controller
{
    public function actions()
    {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
            'captcha' => array(
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ),
        );
    }

    public function actionCreate()
    {
        $ok = false;
        $model = new Image();
        $model->user_id = Yii::$app->user->id ;
//        $model->parent_id = 1;
//        $model->parent_type = '';

            //UploadedFile::getInstance();
//        print_r($_POST);
        $model->load($_POST);
        if ($model->parent_type == 'post' && ($model->parent_id == 0)) {
            $post = new Post();
            $post->status = 'draft';
            if ($post->save(false))
                $model->parent_id = $post->id;
        }
        $error = '1';
        $f = UploadedFile::getInstance($model, 'file_name');
        if ($f) {
            $error = '2';
            $model->file_name = uniqid();
            $model->file_ext = strtolower(strrchr($f->name, '.'));

           //Yii::app()->basePath
             //$l = strrpos($f->name, '.');
            
            $fn = 'content/'.$model->file_name.$model->file_ext;
            if ($f->saveAs($fn)) {
                $file_info = [];
              
                \app\lib\Image::resize($fn, Yii::$app->params['thumbnails'][$model->parent_type], $file_info);

                $error = '3';
                $model->save();
                if ($model->parent_type == 'post')
                    $image_url = $model->getImageUrl('small');
                if ($model->parent_type == 'user') {
                    $image_url = $model->getImageUrl('bigicon');
                    $user = User::findOne($model->parent_id);
                    $user->avatar = $fn;
                    $user->save(false); // disabled validation
                }
                $del_url = Url::toRoute(['image/delete', 'id' => $model->id]);
                $res['status'] = 'ok';
                $res['id'] = $model->id;
                $res['parent_id'] = $model->parent_id;
                $res['img'] = $image_url;
                $res['type'] = $model->parent_type;

               $ok = true;
           }
        }

        if (Yii::$app->request->isAjax) {
            if ($ok) {
                echo json_encode($res);
            } else {
                $res = ['status' => 'error', 'code' => $error];
                echo json_encode($res);
            }
        } else {
            $this->redirect(array('user/show', 'username' => Yii::$app->user->identity->username));
//            $this->redirect(array('post/show', 'id' => $model->parent_id)); 
        }
    }

    public function actionDelete($id)
    {
        $image = Image::findOne($id);
        $res = '{"status": "ok", "id": "'.$image->id.'"}';
        if (Yii::$app->user->id == $image->user_id)
            $image->delete();
        echo $res;
    }
}
