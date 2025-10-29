<?php

namespace Tualo\Office\Profile\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route as BasicRoute;
use Tualo\Office\Basic\IRoute;

class SwitchClient extends \Tualo\Office\Basic\RouteWrapper
{
    public static function register()
    {

        BasicRoute::add('/profile/switchclient/(?P<clientid>[\w.\/\-]+)', function ($matches) {
            App::contenttype('application/json');

            $clients = $_SESSION['tualoapplication']['clients'];
            $clientid = $matches['clientid'];
            App::result('success', false);
            App::result('clients', $clients);
            App::result('clientid', $clientid);
            foreach ($clients as $client) {
                if ($client['client'] == $clientid) {

                    try {
                        App::get('session')->switchClient($clientid);
                        App::result('url', $_SESSION['redirect_url']);
                        // App::result('_SESSION', $_SESSION );

                        $db = App::get('session')->getDB();
                        App::result('db', $db->singleValue('select database() as db_name', [], 'db_name'));


                        App::result('success', true);
                    } catch (\Exception $e) {
                        App::result('error', 'Error while switching client: ' . $e->getMessage());
                        return;
                    }
                }
            }
        }, ['get'], false);
    }
}
