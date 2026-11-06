<?php

namespace Tualo\Office\Profile\Routes;

use Tualo\Office\Basic\TualoApplication;
use Tualo\Office\Basic\Route;
use Tualo\Office\Basic\IRoute;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;

class Avatar extends \Tualo\Office\Basic\RouteWrapper
{
    public static function register()
    {


        Route::add('/classic/resources/client/avatar', function () {
            $db = TualoApplication::get('session')->getDB();
            $size = 44;

            try {

                if (TualoApplication::configuration('profile', 'avatar', 'type') == 'gravatar') {
                    $email_id = $db->dbname;
                    $default = "identicon";
                    $size = 44;

                    $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;
                    http_response_code(200);
                    header("content-type: image/jpeg");
                    TualoApplication::contenttype('image/jpeg');
                    TualoApplication::body(file_get_contents($gravatar_url));
                } else {
                    http_response_code(200);
                    /*
                    
                    $avatar = new InitialAvatar();
                    $image = $avatar->name('OK')->generate();
                    TualoApplication::contenttype('image/jpeg');
                    TualoApplication::body($image->response('jpeg', $size));
*/
                    TualoApplication::contenttype('image/png');
                    $name =  $db->dbname;
                    $avatar = new InitialAvatar();
                    $image = $avatar->name($name)->generate();

                    TualoApplication::body((string) $image->toPng());

                    /*
                    $avatar->name($name)
                        ->length(2)
                        ->fontSize(0.5)
                        ->size(96) // 48 * 2
                        ->background('#8BC34A')
                        ->color('#fff')
                        ->generate()
                        ->stream('png', 100);
                    exit();
                    */
                }
            } catch (\Exception $e) {

                echo $e->getMessage();
                exit();
                $avatar = new InitialAvatar();
                $image = $avatar->name('not set')->generate();
                TualoApplication::contenttype('image/jpeg');
                TualoApplication::body((string) $image->toJpeg($size));
            }
        }, ['get'], true);

        Route::add('/classic/resources/client/avatar/(?P<name>[\w.\/\-]+)', function ($matches) {
            $db = TualoApplication::get('session')->getDB();
            $size = 44;

            try {

                if (TualoApplication::configuration('profile', 'avatar', 'type') == 'gravatar') {
                    $email_id = $matches['name'];
                    $default = "identicon";

                    $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;
                    http_response_code(200);
                    header("content-type: image/jpeg");
                    TualoApplication::contenttype('image/jpeg');
                    TualoApplication::body(file_get_contents($gravatar_url));
                } else {
                    $name =  $matches['name'];
                    $avatar = new InitialAvatar();
                    http_response_code(200);
                    $image = $avatar->name($name)->generate();
                    TualoApplication::contenttype('image/png');
                    TualoApplication::body((string) $image->toPng());
                }
            } catch (\Exception $e) {
                $avatar = new InitialAvatar();
                $image = $avatar->name('not set')->generate();
                TualoApplication::contenttype('image/jpeg');
                TualoApplication::body((string) $image->toJpeg($size));
            }
        }, ['get'], true);

        Route::add('/classic/resources/profile/avatar', function () {

            $db = TualoApplication::get('session')->getDB();
            $size = 44;
            try {

                if (TualoApplication::configuration('profile', 'avatar', 'type') == 'gravatar') {
                    http_response_code(200);
                    $email_id = $db->singleValue('select getSessionUser() v', [], 'v');
                    $default = "identicon";

                    $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;
                    TualoApplication::contenttype('image/jpeg');
                    TualoApplication::body(file_get_contents($gravatar_url));
                } else {
                    http_response_code(200);
                    $name =  $db->singleValue('select getSessionUserFullName() n', [], 'n');
                    if (trim($name) == '') $name = $db->singleValue('select getSessionUser() n', [], 'n');
                    $avatar = new InitialAvatar();
                    $image = $avatar->name($name)->generate();
                    TualoApplication::contenttype('image/png');
                    TualoApplication::body((string) $image->toPng());
                }
            } catch (\Exception $e) {
                $avatar = new InitialAvatar();
                $image = $avatar->name('not set')->generate();
                TualoApplication::contenttype('image/jpeg');
                TualoApplication::body((string) $image->toJpeg($size));
            }
        }, ['get'], true);
    }
}
