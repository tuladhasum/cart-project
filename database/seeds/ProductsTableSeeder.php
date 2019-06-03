<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Laptop
        for ($i=1; $i<30; $i++){
            Product::create([
                'name' => 'Laptop ' . $i,
                'slug' => 'laptop-' . $i,
                'details' => [13, 14, 15][array_rand([13,14,15])].' inch, '. [1,2,3][array_rand([1,2,3])] .' TB SSD, 16GB RAM',
                'price' => rand(149999, 249999),
                'description' => 'Lorem '.$i.' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->withTimestamps()->attach(1);
        }

        $product = Product::find(1);
        $product->categories()->withTimestamps()->attach(2);

        //Desktop
        for ($i=1; $i<30; $i++){
            Product::create([
                'name' => 'Desktop ' . $i,
                'slug' => 'desktop-' . $i,
                'details' => [24, 25,27][array_rand([24,25,27])].' inch, '. [1,2,3][array_rand([1,2,3])] .' TB SSD, 16GB RAM',
                'price' => rand(249999, 449999),
                'description' => 'Lorem '.$i.' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->withTimestamps()->attach(2);
        }

        //Tablet
        for ($i=1; $i<30; $i++){
            Product::create([
                'name' => 'Tablet ' . $i,
                'slug' => 'tablet-' . $i,
                'details' => [24, 25,27][array_rand([24,25,27])].' inch, '. [1,2,3][array_rand([1,2,3])] .' TB SSD, 16GB RAM',
                'price' => rand(249999, 449999),
                'description' => 'Lorem '.$i.' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->withTimestamps()->attach(3);
        }

        //Phone
        for ($i=1; $i<30; $i++){
            Product::create([
                'name' => 'Phone ' . $i,
                'slug' => 'phone-' . $i,
                'details' => [24, 25,27][array_rand([24,25,27])].' inch, '. [1,2,3][array_rand([1,2,3])] .' TB SSD, 16GB RAM',
                'price' => rand(249999, 449999),
                'description' => 'Lorem '.$i.' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            ])->categories()->withTimestamps()->attach(4);
        }



//        Product::create([
//            'name' => 'MacBook Pro',
//            'slug' => 'macbook-pro',
//            'details' => '15 inch, 1TB SSD, 32GB RAM',
//            'price' => 249999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
//        Product::create([
//            'name' => 'Laptop 2',
//            'slug' => 'laptop-2',
//            'details' => '15 inch, 1TB SSD, 16GB RAM',
//            'price' => 149999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
//        Product::create([
//            'name' => 'Laptop 3',
//            'slug' => 'laptop-3',
//            'details' => '13 inch, 1TB SSD, 16GB RAM',
//            'price' => 149999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
//        Product::create([
//            'name' => 'Laptop 4',
//            'slug' => 'laptop-4',
//            'details' => '15 inch, 1TB SSD, 16GB RAM',
//            'price' => 149999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
//        Product::create([
//            'name' => 'Laptop 5',
//            'slug' => 'laptop-5',
//            'details' => '15 inch, 1TB SSD, 16GB RAM',
//            'price' => 149999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
//        Product::create([
//            'name' => 'Laptop 6',
//            'slug' => 'laptop-6',
//            'details' => '15 inch, 1TB SSD, 16GB RAM',
//            'price' => 149999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
//        Product::create([
//            'name' => 'Laptop 7',
//            'slug' => 'laptop-7',
//            'details' => '15 inch, 1TB SSD, 16GB RAM',
//            'price' => 149999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
//        Product::create([
//            'name' => 'Laptop 8',
//            'slug' => 'laptop-8',
//            'details' => '15 inch, 1TB SSD, 16GB RAM',
//            'price' => 149999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
//        Product::create([
//            'name' => 'Laptop 9',
//            'slug' => 'laptop-9',
//            'details' => '15 inch, 1TB SSD, 16GB RAM',
//            'price' => 149999,
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
//        ]);
    }
}
