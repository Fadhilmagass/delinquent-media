<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Album Review',
            'Event Report',
            'New Release',
            'Local Heroes',
            'International Act',
            'Death Metal',
            'Black Metal',
            'Metalcore',
            'Grindcore',
            'Post-Hardcore',
            'Crust Punk',
            'Jakarta',
            'Bandung',
            'Jogja',
            'Surabaya',
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
    }
}
