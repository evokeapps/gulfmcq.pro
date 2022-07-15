<?php
require_once (__DIR__ . '/../src/api.php') or  die;
$dao = DAO::getInstance();
$mcq = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $mcq = $api->getMCQ($id);
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
}
if (isset($_POST['stem']) and strlen($_POST['stem']) > 0) {
    $mcq['stem'] = $_POST['stem'];
    $mcq['opt1'] = $_POST['opt1'];
    $mcq['opt2'] = $_POST['opt2'];
    $mcq['opt3'] = $_POST['opt3'];
    $mcq['opt4'] = $_POST['opt4'];
    $mcq['disc'] = $_POST['disc'];
    $mcq['ref'] = $_POST['ref'];
    $mcq['tags'] = $_POST['tags'];
    if (isset($_POST['id']) and strlen($_POST['id']) > 0) {
        $mcq['_id'] = $_POST['id'];
    }
    $id = $api->updateMCQ($mcq);
    header('Location: /gmp/edit.php?id=' . $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(__DIR__ . '/comp/head.php'); ?>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="/gmp/" class="navbar-brand">Gulf MCQ Pro Admin</a>
        </div>
    </nav>
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/gmp/">Library</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="row mb-2">
                <div class="col">
                    <label for="stem" class="form-label text-secondary">
                        Stem
                    </label>
                    <textarea name="stem" rows="5" class="form-control"><?= trim($mcq['stem']) ?></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="stem" class="form-label text-secondary">
                        Options
                    </label>
                    <input type="text" name="opt1" value="<?= $mcq['opt1'] ?>" class="form-control mb-2">
                    <input type="text" name="opt2" value="<?= $mcq['opt2'] ?>" class="form-control mb-2">
                    <input type="text" name="opt3" value="<?= $mcq['opt3'] ?>" class="form-control mb-2">
                    <input type="text" name="opt4" value="<?= $mcq['opt4'] ?>" class="form-control mb-2">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="stem" class="form-label text-secondary">
                        Discussion
                    </label>
                    <textarea name="disc" rows="15" class="form-control"><?= trim($mcq['disc']) ?></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="ref" class="form-control" value="<?= $mcq['ref'] ?>">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <input type="text" name="tags" class="form-control" value="<?= $mcq['tags'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="hidden" name="id" value="<?= $mcq['_id'] ?>">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>