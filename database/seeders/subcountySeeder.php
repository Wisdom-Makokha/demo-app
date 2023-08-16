<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class subcountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\subcounty::factory()->create([
            'name' => 'Nairobi East',
        ]);

        \App\Models\subcounty::factory()->create([
            'name' => 'Nairobi West'
        ]);
    }
}
