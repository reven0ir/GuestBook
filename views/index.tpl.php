<?php

require_once __DIR__ . '/includes/header.tpl.php';

?>

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
                    <textarea class="form-control" name="message" placeholder="Leave a comment here"
                              id="floatingTextarea"></textarea>
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

            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="card mb-3 <?php if (!$message['status']) echo 'border-danger'; ?>" id="message-<?= $message['id'] ?>">
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
                                        <?php if ($message['status'] == 1): ?>
                                            <a href="?page=<?= $page ?>&do=toggle-status&status=0&id=<?= $message['id'] ?>">Disable</a> |
                                        <?php else: ?>
                                            <a href="?page=<?= $page ?>&do=toggle-status&status=1&id=<?= $message['id'] ?>">Approve</a> |
                                        <?php endif; ?>
                                        <a data-bs-toggle="collapse" href="#collapse-<?= $message['id'] ?>">Edit</a>
                                    </p>

                                    <div class="collapse" id="collapse-<?= $message['id'] ?>">
                                        <form method="post" action="">
                                            <div class="form-floating">
                                                <textarea name="message" class="form-control" placeholder="Leave a comment here"
                                                          id="message-<?= $message['id'] ?>" style="height: 200px"><?= $message['message'] ?></textarea>
                                                <label for="message-<?= $message['id'] ?>">Comments</label>
                                                <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
                                                <input type="hidden" name="page" value="<?= htmlSC($_GET['page'] ?? 1) ?>">
                                                <button name="edit-message" type="submit" class="btn btn-primary mt-3">Save</button>
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

    <?php if (!empty($messages)): ?>
    <div class="row">
        <div class="col-12">

            <?= $pagination ?>

        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.tpl.php'; ?>
