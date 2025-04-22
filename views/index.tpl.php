<?php require_once __DIR__ . '/includes/header.tpl.php'; ?>

    <div class="container mt-5">

        <div class="row">

            <div class="col-12 mb-4">

                <?php
                if (isset($_SESSION['errors'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops...</strong>
                        <?php
                        echo $_SESSION['errors'];
                        unset($_SESSION['errors']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                endif; ?>

                <?php
                if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Congratulation!</strong>
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                endif; ?>

            </div>


            <?php
            if (check_auth()): ?>
                <form action="" method="post" class="mb-2">

                    <div class="form-floating">
                        <textarea class="form-control" name="message" placeholder="Leave a comment here"
                                  id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Comments</label>
                    </div>

                    <button type="submit" name="send-message" class="btn btn-primary mt-3">Send</button>

                </form>

                <div class="col-12">
                    <hr>
                </div>
            <?php
            endif; ?>


        </div>

        <div class="row">

            <div class="col-12">

                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="card mb-3 <?php if (!$message['status']) echo 'border-danger' ?>" id="message-<?= $message['id'] ?>">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title"><?= $message['name'] ?></h5>
                                    <p class="message-created-at"><?= $message['format_created_at'] ?></p>
                                </div>

                                <div class="card-text">
                                    <?= nl2br(htmlSC($message['message'])) ?>
                                </div>

                                <?php if (check_admin()): ?>

                                    <div class="card-actions mt-2">
                                        <p>
                                            <a href="#">Disable</a> |
                                            <a href="#">Approve</a> |
                                            <a data-bs-toggle="collapse" href="#collapse-<?= $message['id'] ?>">Edit</a>
                                        </p>

                                        <div class="collapse" id="collapse-<?= $message['id'] ?>">
                                            <form action="">
                                                <div class="form-floating">

                                <textarea class="form-control" placeholder="Leave a comment here"
                                          id="message-<?= $message['id'] ?>"><?= $message['message'] ?></textarea>
                                                    <label for="message-<?= $message['id'] ?>">Comments</label>
                                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                                </div>


                                            </form>
                                        </div>
                                    </div>

                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Messages not found...</p>
                <?php endif; ?>

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