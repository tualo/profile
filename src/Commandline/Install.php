<?php

namespace Tualo\Office\Profile\Commandline;

use Tualo\Office\Basic\ICommandline;
use Tualo\Office\Basic\CommandLineInstallSQL;

class Install extends CommandLineInstallSQL  implements ICommandline
{
    public static function getDir(): string
    {
        return dirname(__DIR__, 1);
    }
    public static $shortName  = 'profile';
    public static $files = [
        'install/view_session_oauth' => 'setup view_session_oauth ',
        'install/view_session_oauth.ds' => 'setup view_session_oauth.ds ',
        'install/dashboard' => 'setup dashboard ',

    ];
}
