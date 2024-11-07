<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'category_id' => 1,
                'icon' => null,
                'title' => 'Virtual door to door',
                'short_description' => 'With IntelliAI you can virtually knock 500-2500 doors per day!',
                'long_description' => 'Unlock unlimited doors with our SMS campaigns. Virtually knock 500 to 2,500 doors per day with IntelliAI, a leading SMS marketing agency. We specialize in virtual door-to-door campaigns that help businesses engage customers, increase leads, and boost revenue. Try our data-driven strategy with a free trial for those who qualify and see how SMS can transform your outreach.\n\nWe even offer Cold Calling services to boost your business even further!',
                'is_featured' => 0,
            ],
            [
                'category_id' => 3,
                'icon' => null,
                'title' => 'Affordable AI Driven Social Media Marketing',
                'short_description' => 'IntelliAI creates high-converting video ads tailored to your business needs and runs campaigns for you at a fraction of the cost. Powered by AI, our streamlined process allows us to deliver top-quality ads and manage your campaigns effectively, saving you time and money compared to traditional agencies.',
                'long_description' => 'At IntelliAI, we specialize in creating high-converting video ads that are specifically designed to resonate with your target audience. Our team handles everything from ad creation to running and optimizing your campaigns, ensuring maximum reach and engagement.\n\nBecause we\'re AI-powered, we can deliver the same high-quality results as traditional agencies but at a much lower cost. Our advanced AI systems automate much of the creative and campaign management process, making us more efficient and significantly reducing your expenses. You get professionally crafted video ads that drive conversions without breaking the bank, all while allowing you to focus on what matters—growing your business.\n\nLet us take care of the ads and campaigns while you enjoy the results!',
                'is_featured' => 0,
            ],
            [
                'category_id' => 4,
                'icon' => null,
                'title' => 'ONLY Exclusive Leads',
                'short_description' => 'IntelliAI provides exclusive leads for your business, ensuring you are the only one reaching potential customers in your market. Our AI-powered system generates high-quality leads, giving you a competitive edge without the worry of sharing prospects with other companies.',
                'long_description' => 'With IntelliAI, you receive exclusive leads that are tailored specifically to your business, giving you direct access to potential customers in your market. Unlike other services that sell the same leads to multiple businesses, we guarantee that the leads you get are yours alone, so there’s no competition for the same prospects.\n\nOur AI-powered lead generation system targets the right homeowners for your services, ensuring high-quality, relevant leads. This exclusive approach helps you close more deals, stand out in your market, and grow your business faster. Plus, with our cost-effective pricing, you’ll benefit from premium leads without the premium price tag that competitors charge.',
                'is_featured' => 0,
            ],
            [
                'category_id' => 5,
                'icon' => null,
                'title' => 'AI Powered CRM',
                'short_description' => 'IntelliAI sets up a CRM for your business that automates follow-ups, making it easier to stay in touch with leads and clients. You can also use it to request Google reviews and referrals, helping you build trust and grow your business effortlessly.',
                'long_description' => 'Our CRM setup service at IntelliAI is designed to streamline your business operations and improve your client interactions. With automated follow-ups, you’ll never miss a chance to stay connected with your leads and clients. This system helps ensure timely and consistent communication, making it easier to close deals and keep your customers engaged.\n\nIn addition to automating follow-ups, the CRM also allows you to request Google reviews and referrals with just a few clicks. These features help you build a stronger online reputation and generate new business through word of mouth, all while saving you time and effort. By leveraging automation, you can focus on what matters most—growing your business—while the CRM handles the rest.',
                'is_featured' => 0,
            ],
        ];

        foreach ($data as $item) {
            Service::create($item);
        }
    }
}
