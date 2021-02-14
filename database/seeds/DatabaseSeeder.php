<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Role::class, 5)->create()->each(function ($role) {
            $role->users()->save(factory(App\User::class)->make());
        });
    }
}
