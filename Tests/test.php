<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Inilim\Dump\Dump;

// Dump::init();

echo _uuid()->v4();
echo PHP_EOL;
echo _uuid()->_v7();
