<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'title' => 'AI-Powered Personalization',
                'description' => 'Utilize AI to tailor SMS messages to individual customer preferences and behaviors, increasing engagement and conversion rates.',
                'list_items' => ['Behavior analysis', 'Custom message templates', 'Targeted campaigns'],
                'order' => 1,
            ],
            [
                'title' => 'Automated Follow-Up Messages',
                'description' => 'Automatically send follow-up messages to customers to ensure consistent engagement and improve response rates.',
                'list_items' => ['Set intervals for follow-ups', 'Engage with potential leads', 'Boost conversion rates'],
                'order' => 2,
            ],
            [
                'title' => 'Campaign Performance Analytics',
                'description' => 'Get detailed analytics on campaign performance to understand engagement levels and optimize future strategies.',
                'list_items' => ['Open rates', 'Click-through rates', 'Customer feedback analysis'],
                'order' => 3,
            ],
            [
                'title' => 'A/B Testing',
                'description' => 'Test different message formats and timings to determine what resonates best with your audience.',
                'list_items' => ['Compare message variations', 'Optimize engagement', 'Data-driven decision-making'],
                'order' => 4,
            ],
            [
                'title' => 'Geo-Targeting SMS Campaigns',
                'description' => 'Send targeted messages based on customer locations to increase relevance and engagement.',
                'list_items' => ['Location-based offers', 'Event notifications', 'Targeted advertising'],
                'order' => 5,
            ],
        ];

        foreach ($features as $feature) {
            Feature::create([
                'title' => $feature['title'],
                'description' => $feature['description'],
                'list_items' => $feature['list_items'],
                'order' => $feature['order'],
            ]);
        }
    }
}
