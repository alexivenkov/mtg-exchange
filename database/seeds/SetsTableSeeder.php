<?php

use Illuminate\Database\Seeder;

class SetsTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        factory(App\Models\Set::class, 15)->create();
    }
}