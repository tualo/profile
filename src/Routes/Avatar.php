<?php
namespace Tualo\Office\Profile\Routes;
use Tualo\Office\Basic\TualoApplication;
use Tualo\Office\Basic\Route;
use Tualo\Office\Basic\IRoute;
use YoHang88\LetterAvatar\LetterAvatar;

class Avatar implements IRoute{
    public static function register(){
    
        Route::add('/classic/resources/client/avatar',function(){
            $db = TualoApplication::get('session')->getDB();
            $email_id = $db->dbname;
            $default = "identicon";
            $size = 44;

            $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;

            header("content-type: image/jpeg");
            TualoApplication::contenttype('image/jpeg');
            TualoApplication::body(file_get_contents($gravatar_url));

        },['get'],true);

        Route::add('/classic/resources/profile/avatar',function(){

            $db = TualoApplication::get('session')->getDB();
            $email_id = $db->singleValue('select getSessionUser() v',[ ],'v');
            $default = "identicon";
            $size = 44;

            $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;

            header("content-type: image/jpeg");
            TualoApplication::contenttype('image/jpeg');
            TualoApplication::body(file_get_contents($gravatar_url));

        },['get'],true);
    }
}