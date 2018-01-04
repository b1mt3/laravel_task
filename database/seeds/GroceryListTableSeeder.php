<?php

use Illuminate\Database\Seeder;

class GroceryListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GroceryList::class, 10)->create();
    }
}
