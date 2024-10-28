<?php
$sqlParam_sortType = '';
$sqlParam_categories = '';
$sqlParam_brands = '';
$sqlParam_search = '';

switch ($sort_currentSortType) {
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
