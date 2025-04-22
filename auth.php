<?php

session_start();

$title = 'Sing In';

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/views/auth.tpl.php';
