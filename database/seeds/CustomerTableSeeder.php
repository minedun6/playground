<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Project;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('customers')->delete();

        factory(App\Models\Customer::class, 50)->create()->each(function($u) {
            $u->projects()->saveMany(factory(App\Models\Project::class, 3)->make());
        });
    }
}
