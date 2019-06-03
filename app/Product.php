<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function presentPrice()
    {
        return money_format('Rs. %i', $this->price /100);
    }

    public function createAgo()
    {
        return Carbon::createFromTimeString($this->created_at)->diffForHumans();
    }

    public function placeholderImage()
    {
        $randomInt = random_int(1,10);
        return asset("/images/$randomInt.jpg");
//        return "https://github.com/drehimself/laravel-ecommerce-example/blob/4f44e6978e2e0ba969d90b270abae18bc7d49621/public/img/products/laptop-2.jpg?raw=true";
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }
}
