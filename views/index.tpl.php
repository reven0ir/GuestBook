<?php require_once __DIR__ . '/includes/header.tpl.php'; ?>

<div class="container mt-5">
    <div class="row">

        <div class="col-12 mb-4">

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

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Congratulation!</strong>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

        </div>


        <?php if (check_auth()): ?>
            <form action="" method="post" class="mb-2">

                <div class="form-floating">
                    <textarea class="form-control" name="message" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Comments</label>
                </div>

                <button type="submit" name="send-message" class="btn btn-primary mt-3">Send</button>

            </form>

        <div class="col-12">
            <hr>
        </div>
        <?php endif; ?>


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

<?php require_once __DIR__ . '/includes/footer.tpl.php'; ?>