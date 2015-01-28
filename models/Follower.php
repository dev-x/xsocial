<?php

namespace app\models;

class Follower extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'follower';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'id',
            'user_id' => 'User id',
            'following_user_id' => 'following user id',
            );
    }
    
     public function rules()
    {
        return [
            [['user_id', 'following_user_id'], 'required'],
        ];
    }
}
