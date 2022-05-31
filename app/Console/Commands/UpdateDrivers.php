<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ully\Cloudstorages\Database\Seeders\StorageTypeSeeder;

class UpdateDrivers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drivers:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновить список типов хранилищ';

    public string $seederClass = StorageTypeSeeder::class;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('db:seed', [
            '--class' => $this->seederClass
        ]);
        return 0;
    }
}
