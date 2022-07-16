<?php
session_start();
if (!isset($_SESSION['user']) or !strlen($_SESSION['user']) > 0) {
    header('location: /admin/login.php');
}
require_once(__DIR__ . '/../src/dao.php');
$dao = DAO::getInstance();
$count = $dao->getCount();
if (isset($_GET['page']) and strlen($_GET['page']) > 0) {
    $page = intval($_GET['page']);
    if ($page <= 1) {
        $page = 1;
    }
} else {
    $page = intval(ceil($count / 10));
}
$mcqs = $dao->getPage($page);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(__DIR__ . '/../comp/head.php'); ?>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="/admin/" class="navbar-brand">Gulf MCQ Pro Admin</a>
            <a href="/admin/edit.php" class="btn btn-primary btn-sm">New</a>
            <!-- <a href="/admin/backup.php" class="btn btn-danger btn-sm">Backup</a> -->
        </div>
    </nav>
    <div class="container py-4">
        <div class="row mb-4 d-flex align-items-center">
            <div class="col">
                Library: <b><?= $count ?> MCQs</b>
            </div>
            <div class="col text-end">
                <!-- <a href="/admin/index.php?page=<?= $page + 1 ?>" class="btn btn-success btn-sm">Prev Page</a> -->
                <a href="/admin/index.php?page=<?= $page - 1 ?>" class="btn btn-success btn-sm">Next Page</a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <div class="list-group">
                    <?php foreach ($mcqs as $mcq) { ?>
                        <a class="list-group-item list-group-item-action" href="/admin/edit.php?id=<?= $mcq['_id'] ?>">
                            <div class="fs-6 fw-bold"><?= $mcq['_id'] . '. ' . $mcq['stem'] ?></div>
                            <div>1. <?= $mcq['opt1'] ?></div>
                            <div>2. <?= $mcq['opt2'] ?></div>
                            <div>3. <?= $mcq['opt3'] ?></div>
                            <div>4. <?= $mcq['opt4'] ?></div>
                            <?php if (strlen($mcq['disc']) < 1) { ?><div class="badge bg-warning">No discussion</div><?php } ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>