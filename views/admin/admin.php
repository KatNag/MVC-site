<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="/MVC-site/views/_css/access.css" rel="stylesheet">
    <link href="/MVC-site/views/_css/admin.css" rel="stylesheet">

    <script src="/MVC-site/vendor/jquery.js"></script>
    <script src="/MVC-site/views/_js/adminFormat.js"></script>
    <script src="/MVC-site/views/_js/genderChoice.js"></script>
    <script src="/MVC-site/views/_js/files.js"></script>
</head>

<body>

<section>
    <a href="/MVC-site/catalog">
        <img src="/MVC-site/public/images/logos/mainLogo.png" alt="logo">
        CrossWorld
    </a>
    <div>
        <form id="add-product-form" action="/MVC-site/addProduct" enctype="multipart/form-data" method="POST">
            <h1>Добавить товар</h1>
            <label for="name">Название товара</label>
            <input type="text" name="name" id="name" placeholder="Введите название товара" required maxlength="30">

            <label for="price">Цена</label>
            <input type="text" name="price" id="price" placeholder="Введите цену" required>

            <label for="brand">Бренд</label>
            <span class="custom-dropdown big">
                <select id="brand" name="brand" required>
                    <option value="">Выберите бренд</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?php echo $brand['id']; ?>">
                            <?php echo $brand['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </span>

            <label for="brand">Для кого?</label>
            <div class="gender-container">
                <div class="gender-option female">
                    <input type="radio" name="gender" id="female" value="female">
                    <img src="/MVC-site/public/images/photos/womanSneaker.jpg" alt="Female">
                    <p>Для женщин</p>
                </div>
                <div class="gender-option male">
                    <input type="radio" name="gender" id="male" value="male">
                    <img src="/MVC-site/public/images/photos/manSneaker.jpg" alt="Male">
                    <p>Для мужчин</p>
                </div>
            </div>
            <div class="error-message" id="gender-error"></div>

            <label for="brand">Размеры</label>
            <span class="custom-dropdown big">
                <select id="sizes" name="sizes[]" required multiple>
                    <?php foreach ($sizes as $size): ?>
                        <option value="<?php echo $size['id']; ?>">
                            <?php echo $size['scale']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </span>

            <label for="file">Изображение</label>
            <div class="error-message" id="image-error"></div>
            <div class="inputfile-box">
                <input type="file" id="file" name="file" accept="image/*" class="inputfile" onchange='uploadFile(this)'>
                <label for="file">
                    <span id="file-name" class="file-box">Выбрать файл</span>
                </label>
            </div>

            <button type="submit" class="button add-product-button">Добавить товар</button>
        </form>
</section>
</body>
</html>
