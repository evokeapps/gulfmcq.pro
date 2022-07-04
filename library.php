<?php
require_once(__DIR__ . '/src/dao.php');
$message = "";
$dao = DAO::getInstance();
$page = 1;
if (isset($_GET['page']) and strlen($_GET['page']) > 0) {
    $page = $_GET['page'];
}
$mcqs = $dao->getPage($page);
$lastPage = false;
if (count($mcqs) < 10) {
    $lastPage = true;
}
if (count($mcqs) == 0) {
    $message = "Well, that page isn't ready just yet. Check back soon for more questions!";
}
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
                        <li class="breadcrumb-item active" aria-current="page">Library · Page <?= $page ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <?php if (strlen($message) > 0) { ?>
            <div class="row">
                <div class="col text-center">
                    <div class="alert bg-light fs-5 text-secondary"><?= $message ?></div>
                </div>
            </div>
        <?php } ?>
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <?php foreach ($mcqs as $mcq) { ?>
                <div class="col">
                    <div class="p-3 shadow-sm rounded border h-100">
                        <div class="fs-6" style="white-space: pre-wrap;">Q. <?= strlen($mcq['stem']) > 100 ? substr($mcq['stem'], 0, 100) . '…' : $mcq['stem'] ?></div>
                        <br>
                        <?php foreach (['opt1', 'opt2', 'opt3', 'opt4'] as $index => $option) { ?>
                            <div class="fs-6 mb-2 text-secondary"><?= $index + 1 . ' ' . $mcq[$option] ?></div>
                        <?php } ?>
                        <br>
                        <div class="text-start">
                            <a href="/view.php?id=<?= $mcq['_id'] ?>" class="btn btn-text text-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-body-text" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 0 .5Zm0 2A.5.5 0 0 1 .5 2h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm9 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm-9 2A.5.5 0 0 1 .5 4h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Zm5 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm7 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Zm-12 2A.5.5 0 0 1 .5 6h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm8 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm-8 2A.5.5 0 0 1 .5 8h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm7 0a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm-7 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Z" />
                                </svg> Discussion</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row py-5">
            <div class="col text-center">
                <?php if ($page != 1) { ?><a href="/library.php?page=<?= $page - 1 ?>" class="btn btn-success">Prev Page</a><?php } ?>
                <?php if (!$lastPage) { ?><a href="/library.php?page=<?= $page + 1 ?>" class="btn btn-success">Next Page</a><?php } ?>
            </div>
        </div>
    </div>
    <hr>
    <?php include_once(__DIR__ . '/comp/footer.php'); ?>
</body>

</html>