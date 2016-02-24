<?php

namespace Youtubedl;

use Symfony\Component\Process\Process;

class Installation
{
    public static function postUpdate()
    {
        self::postInstall();
    }

    public static function postInstall()
    {
        chmod(Config::getBinFile(), 0775);

    }
}
