<?php
$testData = [
    [
        'img' => 'url1.jpg',
        'title' => 'Product 1',
        'price' => '10.99',
        'rating' => '4.5'
    ],
    [
        'img' => 'url2.jpg',
        'title' => 'Product 2',
        'price' => '15.49',
        'rating' => '4.0'
    ],
    [
        'img' => 'url3.jpg',
        'title' => 'Product 3',
        'price' => '8.99',
        'rating' => '3.8'
    ],
    [
        'img' => 'url4.jpg',
        'title' => 'Product 4',
        'price' => '12.75',
        'rating' => '4.7'
    ],
    [
        'img' => 'url5.jpg',
        'title' => 'Product 5',
        'price' => '22.00',
        'rating' => '5.0'
    ],
    [
        'img' => 'url1.jpg',
        'title' => 'Product 1',
        'price' => '10.99',
        'rating' => '4.5'
    ],
    [
        'img' => 'url2.jpg',
        'title' => 'Product 2',
        'price' => '15.49',
        'rating' => '4.0'
    ],
    [
        'img' => 'url3.jpg',
        'title' => 'Product 3',
        'price' => '8.99',
        'rating' => '3.8'
    ],
    [
        'img' => 'url4.jpg',
        'title' => 'Product 4',
        'price' => '12.75',
        'rating' => '4.7'
    ],
    [
        'img' => 'url5.jpg',
        'title' => 'Product 5',
        'price' => '22.00',
        'rating' => '5.0'
    ],
];

// print_r($testData)
?>

<?php
$currentUrl = $_SERVER['REQUEST_URI'];


$currentPage = 1;
$lastPage = 10;

if (isset($_GET['page'])) {

    $currentPage = $_GET['page'];

    if ($currentPage > $lastPage) {
        $currentPage = $lastPage;

        // Get url param
        $urlComponents = parse_url($currentUrl);
        parse_str($urlComponents['query'], $queryParams);

        // Edit page thing
        $queryParams['page'] = 10;
        $newQueryString = http_build_query($queryParams);

        // Redirect to new url
        $newUrl = $urlComponents['path'] . '?' . $newQueryString;

        header('Location: ' . $newUrl);
        exit();
    }
} else {
    $hasQueries = strpos($currentUrl, '?') === false ? '?page=' : '&page=';
    $newUrl = $currentUrl . $hasQueries . $currentPage;

    header("Location: " . $newUrl);
    exit();
}

if (isset($_GET['sort'])) {
    $currentSortType = $_GET['sort'];
} else {
    // default sortType is latest
    $currentSortType = 'latest';

    $hasQueries = strpos($currentUrl, '?') === false ? '?sort=' : '&sort=';
    $newUrl = $currentUrl . $hasQueries . $currentSortType;
    header("Location: " . $newUrl);
}

function isSortActive($type, $current)
{
    return $current == $type ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../global/styles.css">
    <link rel="stylesheet" href="../global/header/styles.css">
    <link rel="stylesheet" href="../global/footer/styles.css">
</head>

<body class="shop">
    <?php include('../global/header/index.php'); ?>
    <div class="shop-content">
        <div class="shop-filter">
            shop filter placeholder
            <form action="">
                <div class="shop-filter-text">
                    Categories
                </div>

                <input type="checkbox" id="keyboards" name="keyboards" value="keyboards">
                <label for="keyboards">Keyboards</label><br>

                <input type="checkbox" id="mice" name="mice" value="mice">
                <label for="mice">Mice</label><br>

                <input type="checkbox" id="boat" name="boat" value="boat">
                <label for="boat">Boat</label><br>

                <input type="checkbox" id="gpu" name="gpu" value="gpu">
                <label for="gpu">GPU</label><br>

                <input type="checkbox" id="cpu" name="cpu" value="cpu">
                <label for="cpu">CPU</label><br>

                <input type="checkbox" id="ram" name="ram" value="ram">
                <label for="ram">RAM</label><br>

                <input type="checkbox" id="prebuilt" name="prebuilt" value="prebuilt">
                <label for="prebuilt">Pre-built PC's</label><br>

                <div class="shop-filter-text">
                    Price
                </div>

                <input type="number" id="price-min" name="price-min" value="price-min">
                -
                <input type="number" id="price-max" name="price-max" value="price-max">
                <br>

                <div class="shop-filter-text">
                    Brand
                </div>

                <input type="checkbox" id="apple" name="apple" value="apple">
                <label for="apple">Apple</label><br>

                <input type="checkbox" id="samsung" name="samsung" value="samsung">
                <label for="samsung">Samsung</label><br>

                <input type="checkbox" id="sony" name="sony" value="sony">
                <label for="sony">Sony</label><br>

                <input type="checkbox" id="dell" name="dell" value="dell">
                <label for="dell">Dell</label><br>

                <input type="checkbox" id="asus" name="asus" value="asus">
                <label for="asus">ASUS</label><br>

                <input type="submit" value="submit">
                <input type="reset" value="reset">
            </form>
        </div>
        <div class="shop-items-container">
            <div class="shop-sort">
                <div class="shop-sort-button <?php echo isSortActive($currentSortType, 'latest') ?>" id='sort-latest' onclick="handleShopSort('latest')">
                    Latest
                </div>
                <div class="shop-sort-button <?php echo isSortActive($currentSortType, 'highest-rating') ?>" id='sort-highest-rating' onclick="handleShopSort('highest-rating')">
                    Highest Rating
                </div>
                <div class="shop-sort-button <?php echo isSortActive($currentSortType, 'lowest-price') ?>" id='sort-lowest-price' onclick="handleShopSort('lowest-price')">
                    Lowest Price
                </div>
                <div class="shop-sort-button <?php echo isSortActive($currentSortType, 'highest-price') ?>" id='sort-highest-price' onclick="handleShopSort('highest-price')">
                    Highest Price
                </div>
            </div>
            <div class="shop-items">

                <?php foreach ($testData as $shopItem): ?>
                    <div class="shop-item-container">
                        <div class="shop-item card-shop-item">
                            item card placeholder
                            <div class="shop-item-img">
                                <?php echo $shopItem['img'] ?>
                            </div>
                            <div class="shop-item-text">
                                <span class="card-shop-title">title: <?php echo $shopItem['title'] ?></span>
                                <span class="card-shop-price">price: <?php echo $shopItem['price'] ?></span>
                                <span class="card-shop-rating">rating: <?php echo $shopItem['rating'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="shop-paging">
                <div class="paging-container">

                    <!-- <div class="shop-page-button" onclick="handlePrevNext('prev')">
                        <img src=" ../img/icons/arrow-left.svg" class="shop-page-prevnext-icon" alt="">
                    </div> -->
                    <div class="shop-page-button" style="visibility: <?php echo ($currentPage - 1 > 0) ? 'visible' : 'hidden' ?> ;">
                        <img src=" ../img/icons/arrow-left.svg" class="shop-page-prevnext-icon" alt="">
                    </div>

                    <?php for ($i = -2; $i <= 2; $i++): ?>
                        <div class="shop-page-button" style="visibility:<?php echo ($currentPage + $i > 0) && ($currentPage + $i <= $lastPage) ? 'visible' : 'hidden' ?>;">
                            <p><?php echo $currentPage + $i ?></p>
                        </div>
                    <?php endfor; ?>

                    <div class="shop-page-button" style="visibility: <?php echo ($lastPage - $currentPage >= 1) ? 'visible' : 'hidden' ?> ;">
                        <img src=" ../img/icons/arrow-right.svg" class="shop-page-prevnext-icon" alt="">
                    </div>
                    <!-- <div class="shop-page-button" onclick="handlePrevNext('next')">
                        <img src=" ../img/icons/arrow-right.svg" class="shop-page-prevnext-icon" alt="">
                    </div> -->

                </div>
            </div>
        </div>

    </div>
    <?php include('../global/footer/index.php'); ?>

    <script>
        function handleShopSort(currentSortType) {
            // console.log(currentSortType);
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', currentSortType);

            const id = 'sort-' + currentSortType
            // document.getElementById(id).classList.add('active');

            window.location.href = currentUrl.href;
        }

        function handlePrevNext(arg) {
            const currentUrl = new URL(window.location.href);
            console.log(currentUrl.searchParams.get('page'))
            // currentUrl.searchParams.forEach((key, value) => {
            //     console.log(key, value)
            // })

            switch (arg) {
                case 'next':
                    break
                case 'prev':
                    break;
            }
        }
    </script>
</body>

</html>