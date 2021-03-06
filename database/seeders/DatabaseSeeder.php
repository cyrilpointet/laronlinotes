<?php

namespace Database\Seeders;

use Encore\Admin\Auth\Database\AdminTablesSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
//        $this->call(UsersTableSeeder::class);
//        $this->call(NotesTableSeeder::class);
        $this->call(AdminTablesSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
