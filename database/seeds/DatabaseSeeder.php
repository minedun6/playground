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
        DB::table('users')->delete();

        factory(App\Models\User::class, 10)->create();

        $this->call(CustomerTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
    }
}
