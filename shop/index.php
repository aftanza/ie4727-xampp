<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../global/styles.css">
    <link rel="stylesheet" href="../global/header/styles.css">
    <link rel="stylesheet" href="../global/footer/styles.css">
</head>

<!-- Pagination -->
<?php
// Need to add this otherwise php complains for some reason.
session_start();
?>
<?php
$paging_itemsPerPage = 21;
$paging_currentPage = 1;
$paging_lastPage = -1;
$paging_page_offset = ($paging_currentPage - 1) * $paging_itemsPerPage;

function getLastPageFromSqlListingQuery($paging_itemsPerPage, $sqlQuery, $sqlToReplace)
{
    $conn = mysqli_connect('localhost', 'front_end', '123456789', 'xampp_db');
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    $sql_count = str_replace($sqlToReplace, "SELECT COUNT(*) AS total_items", $sqlQuery);

    $res = mysqli_query($conn, $sql_count);
    mysqli_close($conn);

    $res_string = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $totalListings = $res_string[0]['total_items'];

    echo 'total listings: ' . $totalListings;
    echo '<br>';

    $paging_lastPage = ceil($totalListings / $paging_itemsPerPage);
    echo 'last page: ' . $paging_lastPage;
    echo '<br>';
    if ($paging_lastPage == 0) {
        $paging_lastPage = 1;
    }
    return $paging_lastPage;
}

function handlePaging(&$paging_currentPage, &$paging_lastPage)
{
    $currentUrl = $_SERVER['REQUEST_URI'];
    if (isset($_GET['page'])) {
        $paging_currentPage = $_GET['page'];
        if ($paging_currentPage > $paging_lastPage) {
            $newUrl = editPageParam($currentUrl, $paging_lastPage);

            header('Location: ' . $newUrl);
            exit();
        } else if ($paging_currentPage < 1) {

            $newUrl = editPageParam($currentUrl, 1);

            header('Location: ' . $newUrl);
            exit();
        }
    } else {
        $hasQueries = strpos($currentUrl, '?') === false ? '?' : '&';
        $newUrl = $currentUrl . $hasQueries . 'page=1';

        header("Location: " . $newUrl);
        exit();
    }
}

function editPageParam($currentUrl, $targetPage)
{
    // Get url param
    $urlComponents = parse_url($currentUrl);
    parse_str($urlComponents['query'], $queryParams);

    // Edit page thing
    $queryParams['page'] = $targetPage;
    $newQueryString = http_build_query($queryParams);

    // Redirect to new url
    $newUrl = $urlComponents['path'] . '?' . $newQueryString;
    return $newUrl;
};
?>

<!-- Sort Logic -->

<?php
$currentUrl = $_SERVER['REQUEST_URI'];

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
    return $current == $type ? ' active' : '';
};
?>

<!-- Data -->

<?php
$data = [];
$sqlParam_sortType = '';
$sqlParam_categories = '';
$sqlParam_brands = '';
$sqlParam_search = '';

switch ($currentSortType) {
    case 'latest':
        $sqlParam_sortType = 'created_at DESC';
        break;
    case 'highest-rating':
        $sqlParam_sortType = 'rating DESC';
        break;
    case 'highest-price':
        $sqlParam_sortType = 'price DESC';
        break;
    case 'lowest-price':
        $sqlParam_sortType = 'price ASC';
        break;
    default:
        $sqlParam_sortType = 'created_at DESC';
};

$sqlParam_categories = isset($_GET['category']) ? $_GET['category'] : [];
$sqlParam_brands = isset($_GET['brands']) ? $_GET['brands'] : [];
$sqlParam_price_min = isset($_GET['price-min']) ? $_GET['price-min'] : '';
$sqlParam_price_max = isset($_GET['price-max']) ? $_GET['price-max'] : '';
$sqlParam_search = isset($_GET['search']) ? $_GET['search'] : '';

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
    $paging_lastPage
);

// $data = [];

function getListings(
    $params,
    &$paging_itemsPerPage,
    &$paging_currentPage,
    &$paging_page_offset,
    &$paging_lastPage
) {
    $conn = mysqli_connect('localhost', 'front_end', '123456789', 'xampp_db');
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    $sql = 'SELECT id, name, price, rating, img_url FROM listings';

    if ($params['categories']) {
        $sqlParam_categories = array_map(function ($category) {
            return "category = '" . $category . "'";
        }, $params['categories']);
        $sql .= ' WHERE (' . implode(' OR ', $sqlParam_categories) . ') ';
    }

    if ($params['price-min']) {
        if (isThereWhereInString($sql)) {
            $sql .= ' AND ( price >= ' . $params['price-min'] . ' ) ';
        } else {
            $sql .= ' WHERE ( price >= ' . $params['price-min'] . ' ) ';
        }
    }
    if ($params['price-max']) {
        if (isThereWhereInString($sql)) {
            $sql .= ' AND ( price <= ' . $params['price-max'] . ' ) ';
        } else {
            $sql .= ' WHERE ( price <= ' . $params['price-max'] . ' ) ';
        }
    }

    if ($params['brands']) {
        $sqlParam_brands = array_map(function ($brand) {
            return "brand = '" . $brand . "'";
        }, $params['brands']);
        if (isThereWhereInString($sql)) {
            $sql .= ' AND (' . implode(' OR ', $sqlParam_brands) . ') ';
        } else {
            $sql .= ' WHERE (' . implode(' OR ', $sqlParam_brands) . ') ';
        }
    }

    if ($params['search']) {
        if (isThereWhereInString($sql)) {
            $sql .= ' AND ( LOWER(name) LIKE LOWER(' . "'%" . $params['search'] . "%'"  . ')) ';
        } else {
            $sql .= ' WHERE ( LOWER(name) LIKE LOWER(' . "'%" . $params['search'] . "%'" . ')) ';
        }
    }

    if ($params['order_by']) {
        $sql .= ' ORDER BY ' . $params['order_by'];
    }

    // Handle Paging
    $sqlToReplace = "SELECT id, name, price, rating, img_url";

    $paging_lastPage = getLastPageFromSqlListingQuery($paging_itemsPerPage, $sql, $sqlToReplace);
    handlePaging($paging_currentPage, $paging_lastPage);

    $paging_page_offset = ($paging_currentPage - 1) * $paging_itemsPerPage;

    $sql .= ' LIMIT ' . $paging_itemsPerPage . ' OFFSET ' . $paging_page_offset;

    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    echo 'full sql: ' . $sql;
    echo '<br>';

    echo 'page offset: ' . $paging_page_offset;
    echo '<br>';

    echo 'sql result: ' . print_r($res_str);
    echo '<br>';
    echo '<br>';

    echo 'The cannot modify header thing, to remove just remove the pruint_r above';
    echo '<br>';


    mysqli_close($conn);

    return $res_str;

    // if ($res && mysqli_num_rows($res) > 0) {
    //     return mysqli_fetch_all($res, MYSQLI_ASSOC);
    // } else {
    //     echo 'No results found.';
    //     return [];  // Return an empty array if no results are found
    // }

    // print_r($res_string);
};

function isThereWhereInString($str)
{
    if (stripos($str, 'WHERE') !== false) {
        return true;
    } else {
        return false;
    }
}
?>

<body class="shop">
    <?php include('../global/header/index.php'); ?>
    <div class="shop-content">
        <div class="shop-filter" id="shop-filter">
            <form action="." class="Card" onclick="handleFormClick(this)">
                <img src="../img/icons/arrow-right.svg" alt="" class="" onclick="handleArrowClick(this)">
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
                <div class="shop-sort-button Button <?php echo isSortActive($currentSortType, 'latest') ?>" id='sort-latest' onclick="handleShopSort('latest')">
                    Latest
                </div>
                <div class="shop-sort-button Button<?php echo isSortActive($currentSortType, 'highest-rating') ?>" id='sort-highest-rating' onclick="handleShopSort('highest-rating')">
                    Highest Rating
                </div>
                <div class="shop-sort-button Button<?php echo isSortActive($currentSortType, 'lowest-price') ?>" id='sort-lowest-price' onclick="handleShopSort('lowest-price')">
                    Lowest Price
                </div>
                <div class="shop-sort-button Button<?php echo isSortActive($currentSortType, 'highest-price') ?>" id='sort-highest-price' onclick="handleShopSort('highest-price')">
                    Highest Price
                </div>
            </div>
            <div class="shop-items">
                <?php if ($data): ?>
                    <?php foreach ($data as $shopItem): ?>

                        <div class="shop-item-container">
                            <div class="shop-item Card card-shop-item" onclick="handleShopItem(<?php echo $shopItem['id'] ?>)">
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
                        <img src=" ../img/icons/arrow-left.svg" class="shop-page-prevnext-icon" alt="">
                    </div>

                    <?php for ($i = -2; $i <= 2; $i++): ?>
                        <div class="shop-page-button" style="visibility:<?php echo ($paging_currentPage + $i > 0) && ($paging_currentPage + $i <= $paging_lastPage) ? 'visible' : 'hidden' ?>;" onclick="handlePaging('page', <?php echo $paging_currentPage + $i ?>)">
                            <p><?php echo $paging_currentPage + $i ?></p>
                        </div>
                    <?php endfor; ?>

                    <div class="shop-page-button" style="visibility: <?php echo ($paging_lastPage - $paging_currentPage >= 1) ? 'visible' : 'hidden' ?> ;" onclick="handlePaging('next')">
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
        function handleArrowClick(arrowNode) {
            const filterNode = arrowNode.parentNode.parentNode;
            const formNode = arrowNode.parentNode;
            if (arrowNode.classList.contains('active')) {
                arrowNode.classList.remove('active');
                filterNode.classList.remove('active');
                formNode.classList.remove('active');
                setTimeout(() => {
                    filterNode.classList.remove('disable-click');
                }, 0.25)
            } else {
                arrowNode.classList.add('active');
                filterNode.classList.add('active');
            }

        }

        function handleFormClick(formNode) {
            const filterNode = formNode.parentNode;

            if (!filterNode.classList.contains('disable-click')) {
                filterNode.classList.add("active");
                formNode.classList.add("active")
                filterNode.classList.add("disable-click");
                const img = formNode.querySelector('img');
                if (img) {
                    img.classList.add('active');
                }
            }
        }
    </script>

    <script>
        function handleShopSort(currentSortType) {
            // console.log(currentSortType);
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', currentSortType);

            const id = 'sort-' + currentSortType
            // document.getElementById(id).classList.add('active');

            window.location.href = currentUrl.href;
        }

        function handlePaging(arg, value = null) {
            const currentUrl = new URL(window.location.href);
            const currentPage = parseInt(currentUrl.searchParams.get('page'));

            if (arg === 'next') {
                currentUrl.searchParams.set('page', currentPage + 1);
                window.location.href = currentUrl.href;
            } else if (arg === 'prev') {
                currentUrl.searchParams.set('page', currentPage > 1 ? currentPage - 1 : 1);
                window.location.href = currentUrl.href;
            } else if (arg === 'page') {
                currentUrl.searchParams.set('page', value);
                window.location.href = currentUrl.href;
            }

        }

        function handleShopItem(shopItemId) {
            console.log(shopItemId);
            window.location.href = '/shop/item/?id=' + shopItemId;
        }

        function resetURL() {
            window.location.href = '/shop/';
        }
    </script>
</body>

</html>