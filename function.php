<?php

use Inilim\PseudoUUID\UUID;

if (!\function_exists('_uuid')) {
    function _uuid(): UUID
    {
        static $o = null;
        return $o ??= new UUID;
    }
}
