<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Catalog</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>mvc/views/css/catalog.css">
    <script src="<?= BASE_URL ?>mvc/views/js/products.js"></script>
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
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
                <option value="44">44</option>
                <option value="45">45</option>
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
            </button>

            <button class="clear-button" type="button" onclick="clearFilters()">
                <i class=" fas fa-trash"></i>
            </button>
        </div>
    </div>
    <div class="cards-container">
        <?php include 'productCard.php'; ?>
        <?php include 'productCard.php'; ?>
        <?php include 'productCard.php'; ?>
        <?php include 'productCard.php'; ?>
        <?php include 'productCard.php'; ?>
        <?php include 'productCard.php'; ?>
        <?php include 'productCard.php'; ?>
    </div>
</div>
</body>

</html>
