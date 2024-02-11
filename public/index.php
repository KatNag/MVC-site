<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>CrossWorld</title>
</head>

<body>
<?php
$pageTitle = "Главная страница";
$pageContent = [
    'header' => 'mvc/views/header.php',
    'content' => 'mvc/views/content.php',
    'footer' => 'mvc/views/footer.php'
];

foreach ($pageContent as $file) {
    include $file;
}
?>
</body>

</html>
