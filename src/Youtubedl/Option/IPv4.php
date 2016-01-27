<?php
namespace Youtubedl\Option;

use Youtubedl\Option;

/**
 * Class IPv4
 * @package Youtubedl\Option
 * @author Albert Campderrós <albertkampde@gmail.com>
 */
class IPv4 extends Option
{
    /**
     * @return string
     */
    public function format()
    {
        return '-4';
    }
}