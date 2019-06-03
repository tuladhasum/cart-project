<?php

function presentPrice($price)
{
    return money_format('Rs. %i', $price/100);
}
