<?php
require_once(__DIR__ . '/src/dao.php');
$dao = DAO::getInstance();
$id = 1;
if (isset($_GET['id']) and strlen($_GET['id']) > 0) {
    $id = $_GET['id'];
}
$mcq = $dao->getMCQ($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once(__DIR__ . '/comp/head.php'); ?>
</head>

<body>
    <?php include_once(__DIR__ . '/comp/header.php'); ?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="/" class="text-success">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="/library.php" class="text-success">Library</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Question <?= $mcq['_id'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="fs-5">Q. <?= $mcq['stem'] ?></div>
                <br>
                <?php foreach (['opt1', 'opt2', 'opt3', 'opt4'] as $index => $option) { ?>
                    <div class="fs-5 mb-2 text-secondary"><?= $index + 1 . ' ' . $mcq[$option] ?></div>
                <?php } ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="fs-5 fw-bold text-bg-success p-3">
                    Discussion
                </div>
                <br>
                <?php if(strlen($mcq['disc'])>0) { ?>
                <div class="fs-5" style="white-space: pre-wrap;"><?= $mcq['disc'] ?></div>
                <?php } else {?>
                <div class="alert fs-6 text-center bg-light">We are currently working on the discussion of this question. If you would like to contribute, please email us at <a href="mailto:evokeapps@yahoo.com">evokeapps@yahoo.com</a>. Thank you 🤗!</div>
                <?php } ?>
                <br>
                <small class="text-muted fw-bold">Source(s): <?= strlen($mcq['ref'])>0 ? $mcq['ref'] : 'N/A' ?></small>
            </div>
        </div>
        <br>
    </div>
    <hr>
    <?php include_once(__DIR__ . '/comp/footer.php'); ?>
</body>

</html>