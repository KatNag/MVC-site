<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>catalog</title>

    <?php include __DIR__ . '/php/config.php'; ?>

    <link href="<?= BASE_URL ?>mvc/views/css/catalog.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>images/logos/mainLogo.png">
</head>

<body>
<?php
$pageTitle = "Каталог";
$pageContent = [
    'header' => 'mvc/views/header.php',
    'content' => 'mvc/views/products.php',
    'footer' => 'mvc/views/footer.php'
];

foreach ($pageContent as $file) {
    include $file;
}
?>
</body>

</html>
