<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsArticles = [
            [
                'title' => 'AI Revolution in Education',
                'author' => 'Dr. Jane Doe',
                'slug' => 'ai-revolution-in-education',
                'content' => 'Artificial intelligence is redefining how students learn — from personalized lessons to instant language translation. Schools are adopting AI tutors and automated grading systems, enhancing accessibility and inclusivity worldwide.',
                'image' => 'img/Future_AI_Classroom_Learning.png',
                'read_minutes' => 3,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'Climate Change Impact Intensifies',
                'author' => 'Dr. Michael Green',
                'slug' => 'climate-change-impact-intensifies',
                'content' => 'Rising sea levels, prolonged droughts, and catastrophic floods signal an alarming acceleration in climate change. Experts call for urgent, unified action before global temperature thresholds are irreversibly crossed.',
                'image' => 'img/Climate_Apocalypse_Tree_Desolation.png',
                'read_minutes' => 4,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Tech Giants Face New Regulations',
                'author' => 'Sarah Chen',
                'slug' => 'tech-giants-face-new-regulations',
                'content' => 'Governments worldwide are tightening control over major tech corporations. New regulations focus on user data protection, monopolistic behavior, and algorithmic transparency to ensure fair competition and privacy.',
                'image' => 'img/Tech_Regulation_Clash_Art.png',
                'read_minutes' => 5,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Local Startups Thriving Post-Pandemic',
                'author' => 'Ahmad Rahman',
                'slug' => 'local-startups-thriving-post-pandemic',
                'content' => 'Entrepreneurs across Asia report renewed investor interest as local economies rebound. Hybrid work models and digital adoption have accelerated innovation in small businesses, sparking a new wave of regional growth.',
                'image' => 'img/Post_Pandemic_Street_Revival.png',
                'read_minutes' => 3,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(4),
            ],
            [
                'title' => 'Sports Events Return with Energy',
                'author' => 'Maria Rodriguez',
                'slug' => 'sports-events-return-with-energy',
                'content' => 'After years of restrictions, stadiums roar again as fans return to cheer live matches. Sports leagues are experiencing record attendance and engagement both onsite and through streaming platforms.',
                'image' => 'img/Goal_Celebration_Stadium_Triumph.png',
                'read_minutes' => 2,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Global Art Scene Reawakens',
                'author' => 'Elena Petrov',
                'slug' => 'global-art-scene-reawakens',
                'content' => 'Museums and galleries reopen, hosting international exhibitions that highlight resilience and creativity. Artists worldwide are reimagining post-pandemic expression through immersive and digital mediums.',
                'image' => 'img/Art_Reborn_Cosmic_Explosion.png',
                'read_minutes' => 4,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(6),
            ],
            [
                'title' => 'Hollywood Shock: A-List Couple Announces Split',
                'author' => 'Samantha Reyes',
                'slug' => 'hollywood-shock-couple-split',
                'content' => 'In a surprise announcement, one of Hollywood’s most admired couples has confirmed their separation after eight years together. Fans flood social media with mixed reactions as sources hint at conflicting career paths as the main reason.',
                'image' => 'img/Red_Carpet_Split_Shock.png',
                'read_minutes' => 3,
                'is_published' => true,
                'published_at' => Carbon::now()->subDay(),
            ],
            [
                'title' => 'Stock Markets Rally After Central Bank Policy Shift',
                'author' => 'Daniel Wong',
                'slug' => 'stock-markets-rally-central-bank-policy',
                'content' => 'Global stock markets surged today as central banks signaled a softer stance on interest rates. Analysts see renewed investor optimism, particularly in the tech and renewable energy sectors.',
                'image' => 'img/Future_Rally_Triumph.png',
                'read_minutes' => 6,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Fashion Week 2025: Bold Colors and Virtual Runways',
                'author' => 'Alicia Gomez',
                'slug' => 'fashion-week-2025-virtual-runways',
                'content' => 'This year’s Fashion Week stunned audiences as designers merged virtual and physical experiences. Augmented reality and AI-styled collections showcased the future of couture in a post-digital world.',
                'image' => 'img/Future_Fashion_Digital_Runway.png',
                'read_minutes' => 4,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(4),
            ],
            [
                'title' => 'Crypto Chaos: Bitcoin Plunges 15% Overnight',
                'author' => 'Haruto Nakamura',
                'slug' => 'crypto-chaos-bitcoin-plunge',
                'content' => 'Investors are reeling after Bitcoin and major altcoins tumbled sharply following regulatory announcements from key financial markets. Analysts warn of continued volatility as traders rush to safe assets.',
                'image' => 'img/Bitcoin_Crash_Fiery_Descent.png',
                'read_minutes' => 5,
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(8),
            ],
            [
                'title' => 'Celebrity Chef Caught in Restaurant Scandal',
                'author' => 'Lina Rahman',
                'slug' => 'celebrity-chef-restaurant-scandal',
                'content' => 'Social media is buzzing after a viral video surfaced allegedly showing a world-famous chef mistreating staff behind the scenes. Fans call for accountability as sponsors begin distancing themselves from the brand.',
                'image' => 'img/Chef_Scandal_Panic_Tabloid.png',
                'read_minutes' => 3,
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(12),
            ],
            [
                'title' => 'Tech Giants Clash Over Global Data Privacy Laws',
                'author' => 'Priya Menon',
                'slug' => 'tech-giants-clash-privacy-laws',
                'content' => 'Major technology firms are at odds over new international privacy regulations. Industry experts predict a wave of corporate restructuring as compliance deadlines loom.',
                'image' => 'img/Tech_Vs_Privacy_Arm_Wrestle.png',
                'read_minutes' => 6,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Oil Prices Surge Amid Middle East Tensions',
                'author' => 'Ahmed Saleh',
                'slug' => 'oil-prices-surge-middle-east-tensions',
                'content' => 'Crude oil prices jumped 10% overnight following geopolitical escalations in the Middle East. Economists warn of potential ripple effects on inflation and consumer goods worldwide.',
                'image' => 'img/Oil_Surge_Middle_East_Tensions.png',
                'read_minutes' => 5,
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(5),
            ],
            [
                'title' => 'Quantum Computing Breakthrough Promises Faster AI Training',
                'author' => 'Dr. Isaac Nolan',
                'slug' => 'quantum-computing-breakthrough-ai-training',
                'content' => 'Researchers have achieved a major leap in quantum computing, reducing AI model training time from days to mere hours. The discovery could revolutionize industries reliant on massive data processing, from healthcare diagnostics to climate modeling.',
                'image' => 'img/Quantum_AI_Core_Synergy.png',
                'read_minutes' => 6,
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(3),
            ],
            [
                'title' => 'Global Housing Market Cools as Interest Rates Peak',
                'author' => 'Rebecca Tan',
                'slug' => 'global-housing-market-cools',
                'content' => 'Real estate markets across major cities are witnessing a slowdown as mortgage rates hit record highs. Analysts foresee price corrections in 2026, with first-time buyers gaining new opportunities amid falling demand.',
                'image' => 'img/Frozen_Housing_Market_Globe.png',
                'read_minutes' => 5,
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(10),
            ],
            [
                'title' => 'Digital Detox Retreats Gain Popularity',
                'author' => 'Nora Williams',
                'slug' => 'digital-detox-retreats-popularity',
                'content' => 'With screen fatigue at an all-time high, digital detox retreats are emerging as a global wellness phenomenon. From Bali to the Swiss Alps, people are unplugging to reconnect with nature, mindfulness, and themselves.',
                'image' => 'img/Forest_Detox_Morning_Retreat.png',
                'read_minutes' => 4,
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(6),
            ],
        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
    }
}
