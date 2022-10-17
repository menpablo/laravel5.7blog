<?php

namespace App\Helper;

class PasswordGeneratorHelper
{
    public static function generate()
    {
        return bin2hex(openssl_random_pseudo_bytes(4));
    }
}
