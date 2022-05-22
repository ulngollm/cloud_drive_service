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
        $drivers = config('storages.driver');

        DB::table('storage_types')->insertOrIgnore(
            collect($drivers)->keys()
                ->mapWithKeys(function ($item, $key) use ($drivers) {
                    return [
                        'id' => $key + 1,
                        'driver' => $item,
                        'name' => $drivers[$item]['name'],
                    ];
                })->toArray());

    }
}
