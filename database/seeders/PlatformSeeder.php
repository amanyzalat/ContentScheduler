<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Platform;


class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Platform::insert([
            ['name' => 'Twitter', 'type' => 'twitter'],
            ['name' => 'Instagram', 'type' => 'instagram'],
            ['name' => 'LinkedIn', 'type' => 'linkedin'],
            ['name' => 'Facebook', 'type' => 'facebook'],
            ['name' => 'Pinterest', 'type' => 'pinterest'],
        ]);
    }
}
