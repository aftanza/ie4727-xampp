<?php
function convertToStars($rating)
{
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
    $emptyStars = 5 - ($fullStars + $halfStar);

    // Full stars
    $starRating = str_repeat('<span class="star full">★</span>', $fullStars);

    // Half star
    if ($halfStar) {
        $starRating .= '<span class="star half">★</span>';
    }

    // Empty stars
    $starRating .= str_repeat('<span class="star empty">☆</span>', $emptyStars);

    return $starRating;
}
