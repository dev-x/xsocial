<?php
namespace app\lib;

class Str {
    
    private static function _hashTagReplace($zamina){
        return "<a href='../search/hashtag/".$zamina[1]."'>#".$zamina[1]."</a>";
    }
    
    public static function highlightHashTags ($str) {
        return preg_replace_callback("/#([\S]+)/", Array('\app\lib\Str', '_hashTagReplace'), $str);
    }
    
}

?>