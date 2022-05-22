<?php ob_start(); ?>
    <h1 class="text-center"><?= $message ?></h1>
<?php $contentBlock = ob_get_clean(); ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/project/layouts/$layout.php"; ?>
