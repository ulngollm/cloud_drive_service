<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StorageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppported_drivers = collect(config('storages.driver'));

        DB::table('storage_types')->insertOrIgnore(
            $suppported_drivers->mapWithKeys(function ($item, $key) {
                return [
                    'name' => $item['name'],
                    'driver' => $key,
                ];
            })->toArray());

    }
}
