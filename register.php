<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = load(['name', 'email', 'password']);

    $v = new \Valitron\Validator($data);
    $v->rules([
        'required' => ['name', 'email', 'password'],
        'email' => ['email'],
        'lengthMin' => [
                ['password', 6],
        ],
        'lengthMax' => [
                ['name', 50],
                ['email', 50],
        ],
    ]);

    if ($v->validate()) {
        echo 'Success';
    } else {
        debug($v->errors());
    }
}

?>

<?php require_once __DIR__ . '/views/includes/header.tpl.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops...</strong> Seems like error occurred..
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <form method="post">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?= old('name'); ?>">
                        <label for="name">Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?= old('email'); ?>">
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" placeholder="Password"
                               name="password">
                        <label for="password">Password</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Sign Up</button>
                </form>

            </div>
        </div>
    </div>

<?php
require_once __DIR__ . '/views/includes/footer.tpl.php'; ?>