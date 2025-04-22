<?php

session_start();

$title = 'Home';

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/views/index.tpl.php';
