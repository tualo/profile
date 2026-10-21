<?php

namespace Tualo\Office\Profile\Scopes;

use Tualo\Office\Basic\Scope;

class ProfileWriteScope extends Scope
{
    protected static string $identifier = 'profile.write';
    protected static array $name = [
        'EN' => 'Profile',
        'DE' => 'Profil',
    ];
    protected static array $description = [
        'EN' => 'Edit your user profile.',
        'DE' => 'Dein Benutzerprofil bearbeiten.',
    ];
}
