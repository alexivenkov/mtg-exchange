<?php

use Illuminate\Database\Seeder;

class SubtypesTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        factory(App\Models\Subtype::class, 50)->create();
    }
}