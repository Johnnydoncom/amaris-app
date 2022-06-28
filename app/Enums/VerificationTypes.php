<?php
namespace App\Enums;

use ArchTech\Enums\From;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;

enum VerificationTypes:string
{
    use InvokableCases, Names, Values, Options, From;

    case NIN  = 'National Identity Number';
    case PASSPORT = 'International Passport';
    case DRIVERSLICENSE = "Drivers' License";
    case VOTERSCARD = "Voters Card";
    case ADDRESS = "Address";
}

