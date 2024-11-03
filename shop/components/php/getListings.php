<?php
function getListings(
    $params,
    &$paging_itemsPerPage,
    &$paging_currentPage,
    &$paging_page_offset,
    &$paging_lastPage,
    $conn
) {
    $sql = 'SELECT id, name, price, rating, img_url FROM listings';

    // The sqlParam inside these are different from the main file. I forgot I made them the same name.
    if ($params['categories']) {
        $categoryConditions = array_map(function ($category) {
            return "category = '" . $category . "'";
        }, $params['categories']);
        $sql .= ' WHERE (' . implode(' OR ', $categoryConditions) . ') ';
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
        $brandConditions = array_map(function ($brand) {
            return "brand = '" . $brand . "'";
        }, $params['brands']);
        if (isThereWhereInString($sql)) {
            $sql .= ' AND (' . implode(' OR ', $brandConditions) . ') ';
        } else {
            $sql .= ' WHERE (' . implode(' OR ', $brandConditions) . ') ';
        }
    }

    $exactMatchCondition = '';
    if ($params['search']) {
        $decodedSearch = urldecode($params['search']);
        $searchTerms = explode(' ', $decodedSearch);
        $searchConditions = [];

        $exactMatchCondition = 'LOWER(name) = LOWER(' . "'" . $decodedSearch . "'" . ')';

        foreach ($searchTerms as $term) {
            $searchConditions[] = 'LOWER(name) LIKE LOWER(' . "'%" . $term . "%')";
        }

        $likeConditions = implode(' AND ', $searchConditions);

        if (isThereWhereInString($sql)) {
            $sql .= ' AND (' . $exactMatchCondition . ' OR (' . $likeConditions . '))';
        } else {
            $sql .= ' WHERE (' . $exactMatchCondition . ' OR (' . $likeConditions . '))';
        }

        $sql .= ' ORDER BY (' . $exactMatchCondition . ') DESC, ' . $params['order_by'];
    } else {
        $sql .= ' ORDER BY ' . $params['order_by'];
    }


    // Handle Paging
    $sqlToReplace = "SELECT id, name, price, rating, img_url";

    $paging_lastPage = getLastPageFromSqlListingQuery($paging_itemsPerPage, $sql, $sqlToReplace, $conn);
    handlePaging($paging_currentPage, $paging_lastPage);

    $paging_page_offset = ($paging_currentPage - 1) * $paging_itemsPerPage;

    $sql .= ' LIMIT ' . $paging_itemsPerPage . ' OFFSET ' . $paging_page_offset;

    $res = mysqli_query($conn, $sql);
    $res_str = mysqli_fetch_all($res, MYSQLI_ASSOC);

    // echo $sql;

    // echo 'full sql: ' . $sql;
    // echo '<br>';

    // echo 'page offset: ' . $paging_page_offset;
    // echo '<br>';

    // echo 'sql result: ' . print_r($res_str);
    // echo '<br>';
    // echo '<br>';

    // echo 'The cannot modify header thing, to remove just remove the pruint_r above';
    // echo '<br>';

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
