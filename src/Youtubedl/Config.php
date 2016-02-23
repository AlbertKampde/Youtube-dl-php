<?php

namespace Youtubedl;

class Config
{
    public static function removeBinDirectory()
    {
        if (self::binExists()) {
            unlink(self::getBinFile());
            unlink(self::getBinFile().'.exe');
        }
        if (self::binDirectoryExists()) {
            rmdir(self::getBinDirectory());
        }
    }

    public static function makeBinDirectory()
    {
        if (!self::binDirectoryExists()) {
            mkdir(self::getBinDirectory());
        }
    }

    public static function binExists()
    {
        return file_exists(self::getBinFile());
    }

    public static function binDirectoryExists()
    {
        $binDirectory = self::getBinDirectory();
        if (file_exists($binDirectory) && is_dir($binDirectory)) {
            return true;
        }

        return false;
    }

    public static function getBinDirectory()
    {
        $rootDirectory = realpath(__DIR__.'/../../');

        return "{$rootDirectory}/bin";
    }

    public static function getBinFile()
    {
        return self::getBinDirectory().'/Youtubedl';
    }
}
