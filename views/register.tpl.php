<?php require_once __DIR__ . '/includes/header.tpl.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <?php if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops...</strong>
                    <?php
                    echo $_SESSION['errors'];
                    unset($_SESSION['errors']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

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

<?php require_once __DIR__ . '/includes/footer.tpl.php'; ?>
