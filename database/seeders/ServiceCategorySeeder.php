<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Virtual door to door'],
            ['name' => 'Cold Calling'],
            ['name' => 'Social Media Marketing'],
            ['name' => 'Exclusive Lead Generation'],
            ['name' => 'AI- Powered CRM'],
        ];

        foreach ($data as $item) {
            ServiceCategory::create($item);
        }
    }
}
