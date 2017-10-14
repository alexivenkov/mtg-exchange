<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        factory(App\Models\Type::class, 10)->create();
    }
}