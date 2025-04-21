<?php

function debug(array|object $data): void
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

$fillable = ['name', 'email', 'password'];
function load(array $fillable, $post = true): array
{
    $load_data = $post ? $_POST : $_GET;
    $data = [];
    foreach ($fillable as $field) {
        if (isset($load_data[$field])) {
            $data[$field] = trim($load_data[$field]);
        } else {
            $data[$field] = '';
        }
    }
    return $data;
}

function htmlSC(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES);
}

function old(string $name, $post = true): string
{
    $load_data = $post ? $_POST : $_GET;
    return isset($load_data[$name]) ? htmlSC(trim($load_data[$name])) : '';
}