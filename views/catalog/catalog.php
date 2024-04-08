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
<form class="catalog-container" id="catalog-container" action="/MVC-site/sortProducts" method="POST">
    <div class="filters">
        <div class="filter-group">
            <label for="gender-filter">Кому:</label>
            <select id="gender-filter" name="gender-filter">
                <option value="all">Все</option>
                <option value="ж">Женщины</option>
                <option value="м">Мужчины</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="price-range">Цена:</label>
            <input type="text" name="price-range" id="price-range" placeholder="До" oninput="filterPriceInput(this)"/>
        </div>

        <div class=" filter-group">
            <label for="size-filter">Размер:</label>
            <select id="size-filter" name="size-filter">
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
            <select id="sort-options" name="sort-options">
                <option value="price-low">Цена: по возрастанию</option>
                <option value="price-high">Цена: по убыванию</option>
            </select>
        </div>

        <div class="buttons">
            <button class="confirm-button" type="submit">
                <i class="fas fa-check"></i>
            </button>

            <button class="clear-button" type="submit" onclick="clearFilters()">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    <div class="cards-container">
        <?php include ROOT . '/views/product/one.php'; ?>
        <?php include ROOT . '/views/product/cart.php'; ?>
    </div>
</form>
</body>
<script>
    window.onload = function () {
        // Функция для получения значения куки по его имени
        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        // Функция для установки значения куки с именем, значением и сроком хранения
        function setCookie(name, value, options) {
            options = options || {};

            var expires = options.expires;

            if (typeof expires == "number" && expires) {
                var d = new Date();
                d.setTime(d.getTime() + expires * 1000);
                expires = options.expires = d;
            }
            if (expires && expires.toUTCString) {
                options.expires = expires.toUTCString();
            }

            value = encodeURIComponent(value);

            var updatedCookie = name + "=" + value;

            for (var propName in options) {
                updatedCookie += "; " + propName;
                var propValue = options[propName];
                if (propValue !== true) {
                    updatedCookie += "=" + propValue;
                }
            }

            document.cookie = updatedCookie;
        }

        // Проверяем наличие куки для каждого поля формы и устанавливаем соответствующие значения
        var genderFilter = document.getElementById('gender-filter');
        var priceRange = document.getElementById('price-range');
        var sizeFilter = document.getElementById('size-filter');
        var sortOptions = document.getElementById('sort-options');

        var genderFilterValue = getCookie('genderFilterValue');
        if (genderFilterValue !== undefined) {
            genderFilter.value = genderFilterValue;
        }

        var priceRangeValue = getCookie('priceRangeValue');
        if (priceRangeValue !== undefined) {
            priceRange.value = priceRangeValue;
        }

        var sizeFilterValue = getCookie('sizeFilterValue');
        if (sizeFilterValue !== undefined) {
            sizeFilter.value = sizeFilterValue;
        }

        var sortOptionsValue = getCookie('sortOptionsValue');
        if (sortOptionsValue !== undefined) {
            sortOptions.value = sortOptionsValue;
        }

        // Сохраняем значения полей формы в куки при их изменении
        genderFilter.addEventListener('change', function () {
            setCookie('genderFilterValue', this.value, {expires: 3600}); // Сохраняем на 1 час
        });

        priceRange.addEventListener('input', function () {
            setCookie('priceRangeValue', this.value, {expires: 3600});
        });

        sizeFilter.addEventListener('change', function () {
            setCookie('sizeFilterValue', this.value, {expires: 3600});
        });

        sortOptions.addEventListener('change', function () {
            setCookie('sortOptionsValue', this.value, {expires: 3600});
        });
    };
</script>
</html>
