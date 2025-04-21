<?php

require_once __DIR__ . '/includes/db.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guest Book :: Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="auth.php">Sign In</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Hello, User
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">

        <div class="col-12 mb-4">

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops...</strong> Seems like error occurred..
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congratulation!</strong> Great success!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        </div>

        <form action="" class="mb-2">

            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Comments</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Send</button>

        </form>

        <div class="col-12">
            <hr>
        </div>


    </div>
    <div class="row">

        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">User 1</h5>
                        <p class="message-created-at">21.05.2025 18:28</p>
                    </div>

                    <div class="card-text">Some quick example text to build on the card title and make up the bulk of
                        the
                        card's content.
                    </div>

                    <div class="card-actions mt-2">
                        <p>
                            <a href="#">Disable</a> |
                            <a href="#">Approve</a> |
                            <a data-bs-toggle="collapse" href="#collapse-1">Edit</a>
                        </p>

                        <div class="collapse" id="collapse-1">
                            <form action="">
                                <div class="form-floating">

                                <textarea class="form-control" placeholder="Leave a comment here"
                                          id="message-1">Some placeholder content for the collapse component. This panel is hidden by default but
                                revealed when the user activates the relevant trigger.</textarea>
                                    <label for="message-1">Comments</label>
                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                </div>


                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">User 1</h5>
                        <p class="message-created-at">13.06.2025 07:55</p>
                    </div>

                    <div class="card-text">Some quick example text to build on the card title and make up the bulk of
                        the
                        card's content.
                    </div>

                    <div class="card-actions mt-2">
                        <p>
                            <a href="#">Disable</a> |
                            <a href="#">Approve</a> |
                            <a data-bs-toggle="collapse" href="#collapse-2">Edit</a>
                        </p>

                        <div class="collapse" id="collapse-2">
                            <form action="">
                                <div class="form-floating">

                                <textarea class="form-control" placeholder="Leave a comment here"
                                          id="message-2">Some placeholder content for the collapse component. This panel is hidden by default but
                                revealed when the user activates the relevant trigger.</textarea>
                                    <label for="message-2">Comments</label>
                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                </div>


                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>
</html>