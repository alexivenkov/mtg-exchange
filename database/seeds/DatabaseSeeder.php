<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();
        \App\Models\Card::truncate();
        \App\Models\Set::truncate();
        \App\Models\SubType::truncate();
        \App\Models\Type::truncate();

        $this->call(UsersTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(SetsTableSeeder::class);
        $this->call(SubTypesTableSeeder::class);
        $this->call(TypesTableSeeder::class);
    }
}
