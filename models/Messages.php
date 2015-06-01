<?php

namespace app\models;

class Messages extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'message';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }
        public function attributeLabels()
    {
        return array(
            'id' => 'id',
            'user_id' => 'My id',
            'friend_id' => 'friend',
            'created' => 'Time created',
            'stanRead' => 'stan',
            );
    }
    
    function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
        

    public function rules()
    {
        return [
            [['user_id', 'friend_id', 'created', 'stanRead'], 'required'],
        ];
    }

}
