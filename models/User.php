<?php

namespace app\models;

use \yii\web\IdentityInterface;
use yii\helpers\Url;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function scenarios()
    {
        return [
            'login' => ['username', 'password'],
            'register' => ['username', 'email', 'password','mobil','first_name','last_name','group', 'role_id', 'vnz'],
            'profile' => ['first_name','last_name','email','city_id', 'group', 'vnz','groupVnz','mobil','skype','myCredo','myInfo'],
            'activeted' => ['active']
        ];
    }
    
    public static function findByUsername($username)
    {
        return static::findOne(array('username' => $username));
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
//        return $this->password === $password;
    }

    public function getUserImages()
    {
        return $this->hasMany(Image::className(), ['parent_id' => 'id'])->where("parent_type = 'user'");
    }

     public function getFollowingTo()
    {
        return $this->hasMany(Follower::className(), ['user_id' => 'id']);
    }
    
    public function isFollowingTo($follow_to_id){
        $follower = Follower::findOne([
            'user_id' => $this->id,
            'following_user_id' => $follow_to_id,
        ]);
        return $follower ? true : false;
    }
    
    public function isLikes($parent_id, $parent_type){
        $likes = Likes::findOne([
            'user_id' => $this->id,
            'parent_id' => $parent_id,
            'parent_type' => $parent_type,
        ]);
        return $likes ? true : false;
    }
    
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    public function getPublishPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->where("status = 'publish'")->orderBy('post_time DESC');
    }

    public function getPcount() {
        $command = static::getDb()->createCommand("select count(*) as kilk from post where user_id = {$this->id}")->queryAll();
        return $command[0]['kilk'];
    }

    public function getAvatarUrl($size = 'smallicon'){
        if ($this->avatar == null){
            return Url::to('@web/img/no_avatar_'.(empty($this->stat)?'male':$this->stat).'.png');
        } else
            return Url::to('@web/'.str_replace('.', \Yii::$app->params['thumbnails']['user'][$size]['suffix'].'.', $this->avatar));
    }

    public function rules()
    {
        return [
            [['username', 'email', 'first_name', 'last_name', 'password'], 'required'],

            ['username', 'unique', 'message' => 'This username address has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email'],
            ['email', 'unique', 'message' => 'This email address has already been taken.', 'on' => 'signup'],
            
            ['password', 'string', 'min' => 6],
        ];
    }
}
