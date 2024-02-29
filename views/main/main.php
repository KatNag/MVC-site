<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title></title>

    <link href="/MVC-site/views/_css/index.css" rel="stylesheet">
    <link href="/MVC-site/vendor/fancybox/fancybox.css" rel="stylesheet">

    <script src="/MVC-site/vendor/jquery.js"></script>
    <script src="/MVC-site/views/_js/counter.js"></script>
    <script src="/MVC-site/vendor/fancybox/fancybox.js"></script>

</head>

<body>
<div class='hero-section'>
    <div class='company-description'>
        <h1>Добро пожаловать в мир стильных кроссовок!</h1>
        <p>Мы — ваш проводник в увлекательный мир моды и комфорта. Наши кроссовки не просто обувь — это стильный акцент,
            подчеркивающий вашу уникальность.</p>
        <p>Погрузитесь в эстетику удобства с нашей коллекцией, созданной для тех, кто ценит не только стиль, но и
            качество.</p>
        <p>Присоединяйтесь к нам и обретайте не только кроссовки, но и часть нашего сообщества. Вместе мы идем в ногу с
            последними трендами, делая каждый шаг особенным.</p>
    </div>
    <div class='clearBoth'></div>
</div>

<article>
    <div class='mid clearfix'>
        <div id='counter'>
            <div class='bl'>
                <div class='number' data-num='2'>0</div>
                <div class='text'>года на рынке</div>
            </div>
            <div class='bl'>
                <div class='number' data-num='25'>0</div>
                <div class='text'>сотрудников</div>
            </div>
            <div class='bl'>
                <div class='number' data-num='1783'>0</div>
                <div class='text'>проданных пар</div>
            </div>
            <div class='bl'>
                <div class='number' data-num='75'>0</div>
                <div class='text'>брендов</div>
            </div>
        </div>
    </div>
    <div class='clearBoth'></div>
</article>

<div class="photos">
    <div class="photo_element">
        <a data-fancybox="gallery"
           data-src="/MVC-site/public/images/photos/store1.jpg">
            <img src="/MVC-site/public/images/photos/store1.jpg">
        </a>
    </div>

    <div class="photo_element">
        <a data-fancybox="gallery"
           data-src="/MVC-site/public/images/photos/store2.jpeg">
            <img src="/MVC-site/public/images/photos/store2.jpeg">
        </a>
    </div>

    <div class="photo_element">
        <a data-fancybox="gallery"
           data-src="/MVC-site/public/images/photos/store3.jpg">
            <img src="/MVC-site/public/images/photos/store3.jpg">
        </a>
    </div>

    <div class="photo_element">
        <a data-fancybox="gallery"
           data-src="/MVC-site/public/images/photos/store4.jpg">
            <img src="/MVC-site/public/images/photos/store4.jpg">
        </a>
    </div>

    <div class="photo_element">
        <a data-fancybox="gallery"
           data-src="/MVC-site/public/images/photos/store5.jpg">
            <img src="/MVC-site/public/images/photos/store5.jpg">
        </a>
    </div>

    <div class="photo_element">
        <a data-fancybox="gallery"
           data-src="/MVC-site/public/images/photos/store6.jpg">
            <img src="/MVC-site/public/images/photos/store6.jpg">
        </a>
    </div>
    <div class="clearBoth"></div>
</div>

<h2 class='section-title'>Мы находимся здесь</h2>

<div class='map-container'>
    <iframe frameborder='0'
            height='350'
            src='https:yandex.ru/map-widget/v1/?um=constructor%3A66fb05fb8e4b87824510159930505814dea93a3233d4d8f5fc4b3da01fe92b1e&amp;source=constructor'
            width='100%'></iframe>
    <div class='clearBoth'></div>
</div>

<div class='button-zone'>
    <a class='big-button' href='catalog'>Выбрать идеальную пару</a>
</div>
</body>