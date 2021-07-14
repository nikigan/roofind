<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . "/seeders/regions.sql");
        DB::statement($sql);

        $sql = file_get_contents(database_path() . "/seeders/cities.sql");
        DB::statement($sql);
    }
}
