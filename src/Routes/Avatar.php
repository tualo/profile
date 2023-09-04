<?php
namespace Tualo\Office\Profile\Routes;
use Tualo\Office\Basic\TualoApplication;
use Tualo\Office\Basic\Route;
use Tualo\Office\Basic\IRoute;
use YoHang88\LetterAvatar\LetterAvatar;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;

class Avatar implements IRoute{
    public static function register(){
    
        Route::add('/classic/resources/client/avatar',function(){
            $db = TualoApplication::get('session')->getDB();
            $size = 44;

            try{

                if (TualoApplication::configuration('profile','avatar','type')=='gravatar'){
                    $email_id = $db->dbname;
                    $default = "identicon";
                    $size = 44;

                    $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;

                    header("content-type: image/jpeg");
                    TualoApplication::contenttype('image/jpeg');
                    TualoApplication::body(file_get_contents($gravatar_url));
                }else{
                    $name =  $db->dbname;
                    $avatar = new InitialAvatar();
                    $image = $avatar->name($name)->generate();
                    TualoApplication::contenttype('image/png');
                    TualoApplication::body( $image->response('png', $size) );
                }
            }catch(\Exception $e){
                $avatar = new InitialAvatar();
                $image = $avatar->name('not set')->generate();
                TualoApplication::contenttype('image/jpeg');
                TualoApplication::body( $image->response('jpg', $size) );
            }
        },['get'],true);

        Route::add('/classic/resources/client/avatar/(?P<name>[\w.\/\-]+)',function($matches){
            $db = TualoApplication::get('session')->getDB();
            $size = 44;

            try{

                if (TualoApplication::configuration('profile','avatar','type')=='gravatar'){
                    $email_id = $matches['name'];
                    $default = "identicon";

                    $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;

                    header("content-type: image/jpeg");
                    TualoApplication::contenttype('image/jpeg');
                    TualoApplication::body(file_get_contents($gravatar_url));
                }else{
                    $name =  $matches['name'];
                    $avatar = new InitialAvatar();
                    $image = $avatar->name($name)->generate();
                    TualoApplication::contenttype('image/png');
                    TualoApplication::body( $image->response('png', $size) );
                }
            }catch(\Exception $e){
                $avatar = new InitialAvatar();
                $image = $avatar->name('not set')->generate();
                TualoApplication::contenttype('image/jpeg');
                TualoApplication::body( $image->response('jpg', $size) );
            }

        },['get'],true);

        Route::add('/classic/resources/profile/avatar',function(){

            $db = TualoApplication::get('session')->getDB();
            $size = 44;
            try{

                if (TualoApplication::configuration('profile','avatar','type')=='gravatar'){

                    $email_id = $db->singleValue('select getSessionUser() v',[ ],'v');
                    $default = "identicon";
                    
                    $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;
                    TualoApplication::contenttype('image/jpeg');
                    TualoApplication::body(file_get_contents($gravatar_url));

                }else{
                    $name =  $db->singleValue('select getSessionUserFullName() n',[],'n');
                    if (trim($name)=='') $name = $db->singleValue('select getSessionUser() n',[],'n');
                    $avatar = new InitialAvatar();
                    $image = $avatar->name($name)->generate();
                    TualoApplication::contenttype('image/png');
                    TualoApplication::body( $image->response('png', $size) );
                }
            }catch(\Exception $e){
                $avatar = new InitialAvatar();
                $image = $avatar->name('not set')->generate();
                TualoApplication::contenttype('image/jpeg');
                TualoApplication::body( $image->response('jpg', $size) );
            }


        },['get'],true);
    }
}