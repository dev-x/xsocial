<?php
namespace app\lib;

class Message {
    
    
    public static function messageLastSort ($list_user_friend, $list_user_friend2) {
        
        $message_user_sort = array();
        foreach($list_user_friend as $key => $lis){
          $message_user_sort[$key] = array('friend_id' => $key,'content' => end($lis),'created' => key($lis));
        }
        
        $message_user_sort2 = array();
        foreach($list_user_friend2 as $key2 => $lis2){
          $message_user_sort2[$key2] = array('friend_id' => $key2,'content' => end($lis2),'created' => key($lis2));
        }
        
        $last_message_sort = array();
        foreach($message_user_sort as $key => $value){
            foreach($message_user_sort2 as $key2 => $value2){
                //echo $value['created'].'---'.$value2['created'].'<br>';
                if($key == $key2){
                   
                    if($value['created'] >= $value2['created']){
                        $last_message_sort[$key] = array('friend_id' => $key, 'content' => $value['content'],'created' => $value['created']);
                    }else{
                        $last_message_sort[$key] = array('friend_id' => $key, 'content' => $value2['content'],'created' => $value2['created']);
                    }
                }else{
                    $last_message_sort[$key] = array('friend_id' => $key, 'content' => $value['content'],'created' => $value['created']);
                }
            }  
        }
        function build_sorter($key) {
                return function ($a, $b) use ($key) {
                    return strnatcmp($b[$key], $a[$key]);
                };
            }

            usort($last_message_sort, build_sorter('created'));
            
        return $last_message_sort;
    }
    
}

?>