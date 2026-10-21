<?php

namespace Tualo\Office\Profile\Scopes;

use Tualo\Office\Basic\Scope;

class ProfileScope extends Scope
{
    protected static string $identifier = 'profile';
    protected static array $name = [
        'EN' => 'Profile',
        'DE' => 'Profil',
    ];
    protected static array $description = [
        'EN' => 'Read your username and display name.',
        'DE' => 'Deinen Benutzernamen und Anzeigenamen lesen.',
    ];
}
