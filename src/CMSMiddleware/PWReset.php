<?php

namespace Tualo\Office\Profile\CMSMiddleware;

use Tualo\Office\Basic\TualoApplication;

class PWReset
{

    public static function reset(string $username, string $password, ?string $secretPIN): bool
    {
        $db = TualoApplication::get('session')->db;
        if (!is_null($db)) {
            if ($secretPIN === null) return false;
            if ($_SESSION['random_pin'] == $secretPIN) {
                $db->direct('select set_login_sha2({username},{password}) ', [
                    'username' => $username,
                    'password' => $password
                ]);

                return true;
            }
        }
        return false;
    }


    public static function run(&$request, array &$result)
    {
        $result['profile_reset'] = new PWReset();
    }
}
