<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'title' => 'How do I book a service?',
                'description' => 'You can book a service easily from our website or mobile app.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Is there any warranty on repair?',
                'description' => 'Yes, we provide warranty on selected repair services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How can I contact support?',
                'description' => 'You can contact our support team via phone or email.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'What are your service timings?',
                'description' => 'Our service timings are from 9:00 AM to 8:00 PM, Monday to Sunday.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Do you provide doorstep service?',
                'description' => 'Yes, we provide doorstep repair services in selected areas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How much time does a repair take?',
                'description' => 'Most repairs are completed within 24 to 48 hours depending on the issue.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Are spare parts genuine?',
                'description' => 'Yes, we use 100% genuine and quality-tested spare parts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'What payment methods do you accept?',
                'description' => 'We accept cash, UPI, debit cards, and credit cards.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Can I cancel or reschedule my booking?',
                'description' => 'Yes, you can cancel or reschedule your booking before the service starts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Do you offer discounts or offers?',
                'description' => 'Yes, we regularly provide seasonal offers and discounts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
