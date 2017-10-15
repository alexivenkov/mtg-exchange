<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'           => 'test',
            'email'          => 'test@api.com',
            'password'       => bcrypt('root'),
            'remember_token' => str_random(10),
            'api_token'      => str_random(60)
        ]);

        factory(App\Models\User::class, 49)->create();
    }
}
