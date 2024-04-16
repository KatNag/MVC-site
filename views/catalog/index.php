<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $pageTitle ?></title>

    <link href="/pozdeev/MVC-site/views/_css/catalog.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/pozdeev/MVC-site/public/images/logos/mainLogo.png">
</head>
<body>
<?php include($pageContent['header']); ?>
<?php include($pageContent['content']); ?>
<?php include($pageContent['footer']); ?>
</body>
</html>
<?php ob_end_flush(); ?>

