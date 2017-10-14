<?php

use Illuminate\Database\Seeder;

class SubTypesTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        factory(App\Models\SubType::class, 50)->create();
    }
}