<?php
require_once(__DIR__ . '/../src/dao.php');
$dao = DAO::getInstance();
$mcqs = $dao->getPage(1);
$count = $dao->getCount();
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
            <a href="/admin/backup.php" class="btn btn-danger btn-sm">Backup</a>
        </div>
    </nav>
    <div class="container py-4">
        <div class="row mb-4 d-flex align-items-center">
            <div class="col">
                Library: <b><?= $count ?> MCQs</b>
            </div>
            <div class="col text-end">
                <a href="/admin/edit.php" class="btn btn-primary btn-sm">New</a>
            </div>
        </div>

        <div class="row">
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