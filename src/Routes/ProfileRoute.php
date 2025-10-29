<?php

namespace Tualo\Office\Profile\Routes;

use Tualo\Office\Basic\TualoApplication;
use Tualo\Office\Basic\Route;
use Tualo\Office\Basic\IRoute;
use YoHang88\LetterAvatar\LetterAvatar;

class ProfileRoute extends \Tualo\Office\Basic\RouteWrapper
{
    public static function register()
    {

        Route::add('/profile/read', function () {
            TualoApplication::result('success', false);

            try {
                if (
                    isset($_SESSION['tualoapplication']['loggedIn'])
                    && ($_SESSION['tualoapplication']['loggedIn'] == true)
                    && isset($_SESSION['tualoapplication']['username'])
                    && isset($_SESSION['tualoapplication']['clients'])
                    && isset($_SESSION['tualoapplication']['client'])
                    && isset($_SESSION['tualoapplication']['username'])
                ) {
                    $db = TualoApplication::get('session')->db;
                    if (!is_null($db)) {

                        $data = $db->directSingleHash('select * from loginnamen where login={loginname}', array('loginname' => $_SESSION['tualoapplication']['username']));

                        TualoApplication::result('data', $data);
                        TualoApplication::result('success', true);
                    }
                }
            } catch (\Exception $e) {
                TualoApplication::result('msg', $e->getMessage());
            }

            TualoApplication::contenttype('application/json');
        }, array('get', 'post'), true);


        Route::add('/profile/save', function () {
            TualoApplication::result('success', false);

            try {
                $db = TualoApplication::get('session')->db;
                if (!is_null($db)) {
                    $db->direct('
                    insert into loginnamen 
                        (login,vorname,nachname,email,telefon,fax,mobile,zeichen) 
                    values 
                        ({login},{vorname},{nachname},{email},{telefon},{fax},{mobile},{zeichen})
                    
                    on duplicate key update
                        vorname=values(vorname),
                        nachname=values(nachname),
                        email=values(email),
                        telefon=values(telefon),
                        fax=values(fax),
                        mobile=values(mobile),
                        zeichen=values(zeichen)
                    ', [
                        'login' => $_SESSION['tualoapplication']['username'],
                        'vorname' => $_REQUEST['vorname'],
                        'nachname' => $_REQUEST['nachname'],
                        'email' => $_REQUEST['email'],
                        'telefon' => $_REQUEST['telefon'],
                        'fax' => $_REQUEST['fax'],
                        'mobile' => $_REQUEST['mobile'],
                        'zeichen' => $_REQUEST['zeichen']
                    ]);
                    TualoApplication::result('success', true);
                    if ($_SESSION['tualoapplication']['username'] != $_REQUEST['login']) {
                        // change username
                    }
                    if (
                        ($_REQUEST['old_password'] != '')
                        && ($_REQUEST['new_password'] != '')
                    ) {
                        if ($_REQUEST['new_password'] != $_REQUEST['new_password_rep']) throw new \Exception('Die Passwörter stimmen nicht überein!');
                        $_REQUEST['username'] = $_SESSION['tualoapplication']['username'];
                        $sql = 'select * from macc_users where  login={username} and test_login({username},{old_password})=1 ';
                        $res = $db->direct($sql, $_REQUEST);
                        if (count($res) == 1) {
                            $db->direct('select set_login_sha2({username},{new_password}) ', $_REQUEST);
                        } else {
                            throw new \Exception('Das Passwort konnte nicht geändert werden.');
                        }
                    }
                }

                TualoApplication::result('msg', "Änderungen gespeichert.");
            } catch (\Exception $e) {
                TualoApplication::result('success', false);
                TualoApplication::result('msg', $e->getMessage());
            }

            TualoApplication::contenttype('application/json');
        }, array('get', 'post'), true);
    }
}
