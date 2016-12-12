<?php

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->delete();

        factory(App\Models\Project::class, 1000)->create()->each(function($u) {
            $u->tasks()->saveMany(factory(App\Models\Task::class, 20)->make());
        });
    }
}
