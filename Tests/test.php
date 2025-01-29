<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Inilim\Dump\Dump;

// Dump::init();


var_dump(_uuid()->getBytes(_uuid()->v7()));
