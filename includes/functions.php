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

function edit_message(array $data): bool
{
    global $conn;

    if (!check_auth()) {
        $_SESSION['errors'] = 'You must be logged as administrator to edit a message';
        return false;
    }

    $stmt = $conn->prepare("UPDATE messages SET message = ? WHERE id = ?");
    $stmt->execute([$data['message'], $data['message_id']]);
    $_SESSION['success'] = 'Message successfully edited';

    return true;
}

function get_messages(int $start, int $per_page): array
{
    global $conn;

    $where = '';

    if (!check_admin()) {
        $where = 'WHERE status = TRUE';
    }

    $stmt = $conn->prepare("SELECT mg.id, mg.user_id, mg.message, mg.status, TO_CHAR(mg.created_at, 'DD.MM.YYYY HH24:MI') AS format_created_at, users.name FROM messages mg JOIN users ON users.id = mg.user_id {$where} ORDER BY id DESC LIMIT :per_page OFFSET :start");
    $stmt->execute([
        ':per_page' => $per_page,
        ':start' => $start,
    ]);

    return $stmt->fetchAll();
}

function toggle_message_status(int $status, int $id): bool
{
    global $conn;

    if (!check_admin()) {
        $_SESSION['errors'] = 'You must be logged in as an administrator to change the status of a message';
        return false;
    }

    $status = $status ? 1 : 0;

    $stmt = $conn->prepare("UPDATE messages SET status = ? WHERE id = ?");
    return $stmt->execute([$status, $id]);
}

function get_count_messages(): int
{
    global $conn;

    $where = '';

    if (!check_admin()) {
        $where = 'WHERE status = TRUE';
    }

    $result = $conn->query("SELECT COUNT(*) FROM messages {$where}");
    return $result->fetchColumn();
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