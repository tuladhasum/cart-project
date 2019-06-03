<?php

function presentPrice($price)
{
    return money_format('Rs. %i', $price/100);
}

function setActiveCategory($category, $output = 'active'){
    return request()->category == $category ? $output : '';
}
