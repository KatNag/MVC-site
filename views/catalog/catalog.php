<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="stylesheet" href="/MVC-site/views/_css/catalog.css">
    <link rel="stylesheet" href="/MVC-site/vendor/fontawesome.css">
    <script src="/MVC-site/views/_js/catalog.js"></script>
</head>

<body>
<div class="catalog-container">
    <div class="filters">
        <div class="filter-group">
            <label for="gender-filter">Кому:</label>
            <select id="gender-filter">
                <option value="all">Все</option>
                <option value="women">Женщины</option>
                <option value="men">Мужчины</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="price-range">Цена:</label>
            <input type="text" id="price-range" placeholder="До" oninput="filterPriceInput(this)"/>
        </div>

        <div class=" filter-group">
            <label for="size-filter">Размер:</label>
            <select id="size-filter">
                <option value="all">Все</option>
                <?php foreach ($sizes as $size): ?>
                    <option value="<?php echo $size['id']; ?>">
                        <?php echo $size['scale']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </select>
        </div>

        <div class="filter-group">
            <label for="sort-options">Сортировка:</label>
            <select id="sort-options">
                <option value="price-low">Цена: по возрастанию</option>
                <option value="price-high">Цена: по убыванию</option>
            </select>
        </div>

        <div class="buttons">
            <button class="confirm-button" type="button">
                <i class="fas fa-check"></i>
                <!--                TO DO: реакции на сортировку и фильтры-->
            </button>

            <button class="clear-button" type="button" onclick="clearFilters()">
                <i class="fas fa-trash"></i>
                <!--                TO DO: убрать на сортировку и фильтры-->
            </button>
        </div>
    </div>
    <div class="cards-container">
        <!--        TO DO: Здесь с сервера должны заполненные карточки должны отображаться-->
        <?php include ROOT . '/views/product/cart.php'; ?>
    </div>
</div>
</body>
</html>
