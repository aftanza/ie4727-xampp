<?php
$paging_itemsPerPage = 20;
$paging_currentPage = 1;
$paging_lastPage = -1;
$paging_page_offset = ($paging_currentPage - 1) * $paging_itemsPerPage;

function getLastPageFromSqlListingQuery($paging_itemsPerPage, $sqlQuery, $sqlToReplace, $conn)
{
    $conn = db_connect();

    $sql_count = str_replace($sqlToReplace, "SELECT COUNT(*) AS total_items", $sqlQuery);

    $res = mysqli_query($conn, $sql_count);
    mysqli_close($conn);

    $res_string = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $totalListings = $res_string[0]['total_items'];

    // echo 'total listings: ' . $totalListings;
    // echo '<br>';

    $paging_lastPage = ceil($totalListings / $paging_itemsPerPage);
    // echo 'last page: ' . $paging_lastPage;
    // echo '<br>';
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
