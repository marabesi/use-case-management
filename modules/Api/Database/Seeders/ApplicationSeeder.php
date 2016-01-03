<?php

namespace Modules\Api\Database\Seeders;

require __DIR__ . '/../Factories/ModelFactory.php';

use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Modules\Api\Models\Application::class, 10)->create();
    }
}