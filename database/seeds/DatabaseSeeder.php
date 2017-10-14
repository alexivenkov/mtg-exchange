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
        \DB::statement('set foreign_key_checks = 0');
        \App\Models\User::truncate();
        \App\Models\Card::truncate();
        \App\Models\Set::truncate();
        \App\Models\Subtype::truncate();
        \App\Models\Type::truncate();
        \DB::statement('set foreign_key_checks = 1');

        $this->call(UsersTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(SetsTableSeeder::class);
        $this->call(SubtypesTableSeeder::class);
        $this->call(TypesTableSeeder::class);
    }
}
