<?php
$currentUrl = $_SERVER['REQUEST_URI'];

if (isset($_GET['sort'])) {
    $sort_currentSortType = $_GET['sort'];
} else {
    // default sortType is latest
    $sort_currentSortType = 'relevant';

    $hasQueries = strpos($currentUrl, '?') === false ? '?sort=' : '&sort=';
    $newUrl = $currentUrl . $hasQueries . $sort_currentSortType;
    header("Location: " . $newUrl);
}

function isSortActive($type, $current)
{
    return $current == $type ? ' active' : '';
};
