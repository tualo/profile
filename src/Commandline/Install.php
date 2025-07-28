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
        'view_session_oauth' => 'setup view_session_oauth ',
        'dashboard' => 'setup dashboard ',

    ];
}
