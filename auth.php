<?php

session_start();

$title = 'Sign In';

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/vendor/autoload.php';

if (check_auth()) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = load(['email', 'password']);

    $v = new \Valitron\Validator($data);
    $v->rules([
        'required' => ['email', 'password'],
        'email' => ['email'],
    ]);

    if ($v->validate()) {
        if (login($data)) {
            redirect('index.php');
        } else {
            redirect('auth.php');
        }
    } else {
        $_SESSION['errors'] = get_errors($v->errors());
    }
}

require_once __DIR__ . '/views/auth.tpl.php';