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
                'image' => 'https://ik.imagekit.io/0j4v080uc/services/1768033616_Mls7qoVn87_a3GfZJq15.png',
                'image_url' => 'https://ik.imagekit.io/0j4v080uc/services/1768033616_Mls7qoVn87_a3GfZJq15.png',
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
                'image' => 'https://ik.imagekit.io/0j4v080uc/services/1768033410_buHS0X3J7p_inMq0reak.png',
                'image_url' => 'https://ik.imagekit.io/0j4v080uc/services/1768033410_buHS0X3J7p_inMq0reak.png',
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
                'image' => 'https://ik.imagekit.io/0j4v080uc/services/1768033352_jgISKOxeuc_6pg9WW7fM.png',
                'image_url' => 'https://ik.imagekit.io/0j4v080uc/services/1768033352_jgISKOxeuc_6pg9WW7fM.png',
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
                'image' => 'https://ik.imagekit.io/0j4v080uc/services/1768033323_08jVwwbtRY_lwE1BCtdE.png',
                'image_url' => 'https://ik.imagekit.io/0j4v080uc/services/1768033323_08jVwwbtRY_lwE1BCtdE.png',
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
                'image' => 'https://ik.imagekit.io/0j4v080uc/services/1768033339_QmPMQFGqui_2h8FN-8ts.png',
                'image_url' => 'https://ik.imagekit.io/0j4v080uc/services/1768033339_QmPMQFGqui_2h8FN-8ts.png',
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
