<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_rates')->insert([
            [
                'service_id' => 1,
                'title' => 'Basic Cleaning',
                'duration' => '1 hour',
                'price' => 50.00,
                'discount_price' => 45.00,
                'includes' => json_encode(['Dusting', 'Vacuuming', 'Mopping']),
            ],
            [
                'service_id' => 1,
                'title' => 'Deep Cleaning',
                'duration' => '3 hours',
                'price' => 150.00,
                'discount_price' => 130.00,
                'includes' => json_encode(['All Basic Cleaning Services', 'Window Cleaning', 'Carpet Shampooing']),
            ],
            [
                'service_id' => 1,
                'title' => 'Standard Plumbing',
                'duration' => '2 hours',
                'price' => 100.00,
                'discount_price' => 90.00,
                'includes' => json_encode(['Leak Fixing', 'Pipe Inspection']),
            ],
            [
                'service_id' => 2,
                'title' => 'Emergency Plumbing',
                'duration' => '4 hours',
                'price' => 200.00,
                'discount_price' => 180.00,
                'includes' => json_encode(['All Standard Plumbing Services', '24/7 Availability', 'Emergency Repairs']),
            ],
            [
                'service_id' => 2,
                'title' => 'Basic Electrical',
                'duration' => '1.5 hours',
                'price' => 80.00,
                'discount_price' => 70.00,
                'includes' => json_encode(['Wiring Check', 'Outlet Installation']),
            ],
            [
                'service_id' => 2,
                'title' => 'Advanced Electrical',
                'duration' => '3 hours',
                'price' => 160.00,
                'discount_price' => 140.00,
                'includes' => json_encode(['All Basic Electrical Services', 'Circuit Breaker Replacement', 'Lighting Installation']),
            ],
            [
                'service_id' => 3,
                'title' => 'Standard HVAC Service',
                'duration' => '2 hours',
                'price' => 120.00,
                'discount_price' => 110.00,
                'includes' => json_encode(['Filter Replacement', 'System Inspection']),
            ],
            [
                'service_id' => 3,
                'title' => 'Comprehensive HVAC Service',
                'duration' => '4 hours',
                'price' => 220.00,
                'discount_price' => 200.00,
                'includes' => json_encode(['All Standard HVAC Services', 'Duct Cleaning', 'Thermostat Installation']),
            ],
            [
                'service_id' => 3,
                'title' => 'Basic Gardening',
                'duration' => '1 hour',
                'price' => 40.00,
                'discount_price' => 35.00,
                'includes' => json_encode(['Lawn Mowing', 'Weeding']),
            ],
            [
                'service_id' => 4,
                'title' => 'Full Garden Maintenance',
                'duration' => '3 hours',
                'price' => 120.00,
                'discount_price' => 100.00,
                'includes' => json_encode(['All Basic Gardening Services', 'Hedge Trimming', 'Plant Care']),
            ],
            [
                'service_id' => 4,
                'title' => 'Basic Pest Control',
                'duration' => '1 hour',
                'price' => 60.00,
                'discount_price' => 50.00,
                'includes' => json_encode(['Inspection', 'Basic Treatment']),
            ],
            [
                'service_id' => 4,
                'title' => 'Comprehensive Pest Control',
                'duration' => '3 hours',
                'price' => 180.00,
                'discount_price' => 160.00,
                'includes' => json_encode(['All Basic Pest Control Services', 'Advanced Treatment', 'Follow-up Visit']),
            ],
            [
                'service_id' => 2,
                'title' => 'Standard Painting',
                'duration' => '4 hours',
                'price' => 300.00,
                'discount_price' => 280.00,
                'includes' => json_encode(['Wall Preparation', 'Primer Application', 'Two Coats of Paint']),
            ],
            [
                'service_id' => 3,
                'title' => 'Premium Painting',
                'duration' => '8 hours',
                'price' => 600.00,
                'discount_price' => 550.00,
                'includes' => json_encode(['All Standard Painting Services', 'High-Quality Paint', 'Custom Finishes']),
            ],
            
        ]);
    }
}
