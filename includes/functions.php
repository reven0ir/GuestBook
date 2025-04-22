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

function redirect(string $url = ''): never
{
    header("Location: {$url}");
    die;
}

function get_errors(array $errors): string
{
    $html = '<ul class="list-unstyled">';

    foreach ($errors as $error_groups) {
        foreach ($error_groups as $error) {
            $html .= "<li>{$error}</li>";
        }
    }

    $html .= '</ul>';

    return $html;
}

function register(array $data): bool
{
    global $conn;

    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);

    if ($stmt->fetchColumn()) {
        $_SESSION['errors'] = 'Email already exists';
        return false;
    }

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute($data);

    $_SESSION['success'] = 'You are successfully registered';

    return true;
}

function login(array $data): bool
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);

    if ($row = $stmt->fetch()) {
        if (!password_verify($data['password'], $row['password'])) {
            $_SESSION['errors'] = 'Wrong email or password';
            return false;
        }
    } else {
        $_SESSION['errors'] = 'Wrong email or password';
        return false;
    }

    foreach ($row as $key => $value) {
        if ($key != 'password') {
            $_SESSION['user'][$key] = $value;
        }
    }
    $_SESSION['success'] = 'You are successfully login';

    return true;
}

function save_message(array $data): bool
{
    global $conn;

    if (!check_auth()) {
        $_SESSION['errors'] = 'You must be logged in to send a message';
        return false;
    }

    $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user']['id'], $data['message']]);
    $_SESSION['success'] = 'Message successfully sent';

    return true;
}

function get_messages(): array
{
    global $conn;

    $where = '';

    if (!check_admin()) {
        $where = 'WHERE status = TRUE';
    }

    $stmt = $conn->prepare("SELECT * FROM messages {$where}");
    $stmt->execute();

    return $stmt->fetchAll();
}

function check_auth(): bool
{
    if (isset($_SESSION['user'])) {
        return true;
    }
    return false;
}

function check_admin(): bool
{
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 2) {
        return true;
    }
    return false;
}