<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'name' => 'Mobile Repair',
                'slug' => Str::slug('Mobile Repair'),
                'image' => 'services/mobile-repair.png',
                'requirements' => json_encode([
                    'Device model',
                    'Problem description',
                    'Warranty status',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop Repair',
                'slug' => Str::slug('Laptop Repair'),
                'image' => 'services/laptop-repair.png',
                'requirements' => json_encode([
                    'Laptop brand',
                    'Operating system',
                    'Issue details',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AC Repair',
                'slug' => Str::slug('AC Repair'),
                'image' => 'services/ac-repair.png',
                'requirements' => json_encode([
                    'AC type (Split/Window)',
                    'Brand name',
                    'Issue description',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Washing Machine Repair',
                'slug' => Str::slug('Washing Machine Repair'),
                'image' => 'services/washing-machine.png',
                'requirements' => json_encode([
                    'Machine type (Top/Front load)',
                    'Brand',
                    'Problem details',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Refrigerator Repair',
                'slug' => Str::slug('Refrigerator Repair'),
                'image' => 'services/refrigerator.png',
                'requirements' => json_encode([
                    'Refrigerator type',
                    'Brand name',
                    'Cooling issue details',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
