<?php require('global/persist/account_persist.php'); ?>
<?php require('global/php/db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="/global/styles.css">
    <link rel="stylesheet" href="/global/header/styles.css">
    <link rel="stylesheet" href="/global/footer/styles.css">

    <?php include('global/font/font.php'); ?>
</head>

<!-- Pagination -->
<?php require_once './components/php/paging.php'; ?>

<!-- Sort Logic -->
<?php require_once './components/php/sort.php'; ?>

<!-- Data -->
<?php
$data = [];
require_once './components/php/sqlParam.php';
require_once './components/php/getListings.php';

$conn = db_connect();

$data = getListings(
    [
        'order_by' => $sqlParam_sortType,
        'categories' => $sqlParam_categories,
        'brands' => $sqlParam_brands,
        'price-min' => $sqlParam_price_min,
        'price-max' => $sqlParam_price_max,
        'search' => $sqlParam_search
    ],
    $paging_itemsPerPage,
    $paging_currentPage,
    $paging_page_offset,
    $paging_lastPage,
    $conn
);
?>

<body class="shop">
    <?php include('global/header/index.php'); ?>
    <div class="shop-content Content">
        <div class="shop-filter" id="shop-filter">
            <form action="." class="Card" onclick="handleFormClick(this)">
                <img src="/img/icons/arrow-right.svg" alt="" class="" onclick="handleArrowClick(this)">
                <div class="shop-filter-category">
                    <div class="shop-filter-text">
                        <h1>Categories</h1>
                    </div>

                    <?php $categories = ['Keyboards', 'Mice', 'Gpu', 'Cpu', 'Ram', 'Prebuilt'] ?>
                    <?php $current_categories = isset($_GET['category']) ? $_GET['category'] : []; ?>

                    <?php foreach ($categories as $category): ?>
                        <?php $category_lower = strtolower($category) ?>
                        <input type="checkbox" id="filter-<?php echo $category_lower ?>" name="category[]" value="<?php echo $category_lower ?>" <?php echo in_array($category_lower, $current_categories) ? 'checked' : '' ?>>
                        <label for="filter-<?php echo $category_lower ?>"><?php echo $category ?></label><br>
                    <?php endforeach; ?>
                </div>

                <div class="shop-filter-price">
                    <div class="shop-filter-text">
                        <h1>Price</h1>
                    </div>

                    <?php $minPrice = isset($_GET['price-min']) ? $_GET['price-min'] : ''; ?>
                    <?php $maxPrice = isset($_GET['price-max']) ? $_GET['price-max'] : ''; ?>

                    <div class="shop-filter-price-input-container">
                        <input type="number" id="price-min" name="price-min" value="<?php echo $minPrice ?>">
                        &nbsp&nbsp-&nbsp&nbsp&nbsp&nbsp
                        <input type="number" id="price-max" name="price-max" value="<?php echo $maxPrice ?>">
                    </div>


                </div>

                <div class="shop-filter-brand">
                    <div class="shop-filter-text">
                        <h1>Brand</h1>
                    </div>

                    <?php $brands = ['Apple', 'Samsung', 'Sony', 'Dell', 'ASUS'] ?>
                    <?php $current_brands = isset($_GET['brands']) ? $_GET['brands'] : []; ?>
                    <?php foreach ($brands as $brand): ?>
                        <?php $brand_lower = strtolower($brand) ?>
                        <input type="checkbox" id="brand-<?php echo $brand_lower ?>" name="brands[]" value="<?php echo $brand_lower ?>" <?php echo in_array($brand_lower, $current_brands) ? 'checked' : '' ?>>
                        <label for="brand-<?php echo $brand_lower ?>"><?php echo $brand ?></label><br>
                    <?php endforeach; ?>
                </div>

                <div class="shop-filter-buttons">
                    <input type="submit" value="submit" class="Button">
                    <input type="reset" value="reset" onclick="resetURL()" class="Button">
                </div>

            </form>
        </div>
        <div class="shop-items-container">
            <div class="shop-sort">
                <div class="shop-sort-button Button <?php echo isSortActive($sort_currentSortType, 'latest') ?>" id='sort-latest' onclick="handleShopSort('latest')">
                    Latest
                </div>
                <div class="shop-sort-button Button<?php echo isSortActive($sort_currentSortType, 'highest-rating') ?>" id='sort-highest-rating' onclick="handleShopSort('highest-rating')">
                    Highest Rating
                </div>
                <div class="shop-sort-button Button<?php echo isSortActive($sort_currentSortType, 'lowest-price') ?>" id='sort-lowest-price' onclick="handleShopSort('lowest-price')">
                    Lowest Price
                </div>
                <div class="shop-sort-button Button<?php echo isSortActive($sort_currentSortType, 'highest-price') ?>" id='sort-highest-price' onclick="handleShopSort('highest-price')">
                    Highest Price
                </div>
            </div>
            <div class="shop-items">
                <?php if ($data): ?>
                    <?php foreach ($data as $shopItem): ?>

                        <div class="shop-item-container">
                            <div class="shop-item Card Card--shop card-shop-item" onclick="handleShopItem(<?php echo $shopItem['id'] ?>)">
                                <div class="shop-item-img">
                                    <?php echo $shopItem['img_url'] ?>
                                </div>
                                <div class="shop-item-text">
                                    <span class="card-shop-title"><?php echo $shopItem['name'] ?></span>
                                    <span class="card-shop-price"><?php echo $shopItem['price'] ?></span>
                                    <span class="card-shop-rating"><?php echo $shopItem['rating'] ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    NO RESULT
                <?php endif; ?>

            </div>
            <div class="shop-paging">
                <div class="paging-container">

                    <!-- <div class="shop-page-button" onclick="handlePrevNext('prev')">
                        <img src=" ../img/icons/arrow-left.svg" class="shop-page-prevnext-icon" alt="">
                    </div> -->
                    <div class="shop-page-button" style="visibility: <?php echo ($paging_currentPage - 1 > 0) ? 'visible' : 'hidden' ?> ;" onclick="handlePaging('prev')">
                        <img src=" /img/icons/arrow-left.svg" class="shop-page-prevnext-icon" alt="">
                    </div>

                    <?php for ($i = -2; $i <= 2; $i++): ?>
                        <div class="shop-page-button <?php echo ($i == 0 ? 'active' : '') ?>" style="visibility:<?php echo ($paging_currentPage + $i > 0) && ($paging_currentPage + $i <= $paging_lastPage) ? 'visible' : 'hidden' ?>;" onclick="handlePaging('page', <?php echo $paging_currentPage + $i ?>)">
                            <p><?php echo $paging_currentPage + $i ?></p>
                        </div>
                    <?php endfor; ?>

                    <div class="shop-page-button" style="visibility: <?php echo ($paging_lastPage - $paging_currentPage >= 1) ? 'visible' : 'hidden' ?> ;" onclick="handlePaging('next')">
                        <img src=" /img/icons/arrow-right.svg" class="shop-page-prevnext-icon" alt="">
                    </div>
                    <!-- <div class="shop-page-button" onclick="handlePrevNext('next')">
                        <img src=" ../img/icons/arrow-right.svg" class="shop-page-prevnext-icon" alt="">
                    </div> -->

                </div>
            </div>
        </div>

    </div>
    <?php include('global/footer/index.php'); ?>

    <script type="module" src="./components/js/allScripts.js"></script>
</body>

</html>