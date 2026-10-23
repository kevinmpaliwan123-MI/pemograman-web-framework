<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penerbit = [
            ['name' => 'Gramedia Pustaka Utama', 'city' => 'Jakarta'],
            ['name' => 'Mizan Pustaka',           'city' => 'Bandung'],
            ['name' => 'Bentang Pustaka',          'city' => 'Yogyakarta'],
        ];

        foreach ($penerbit as $data) {
            Publisher::firstOrCreate(
                ['name' => $data['name']],
                ['city' => $data['city']]
            );
        }
    }
}
