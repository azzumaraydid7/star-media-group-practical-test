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
                'category_id' => 1,
                'text' => '<h2>The New Face of Learning</h2>
            <p>AI is personalizing education like never before. Adaptive algorithms analyze student progress, offering real-time feedback and recommendations that match individual strengths and weaknesses.</p>
            <ul>
                <li>Virtual AI tutors help students master topics faster.</li>
                <li>Automated grading systems save educators valuable time.</li>
                <li>AI-driven analytics predict learning outcomes accurately.</li>
            </ul>
            <p>As schools embrace this technology, accessibility and inclusion reach new heights—especially for remote and special-needs learners worldwide.</p>
        ',
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
                'category_id' => 8,
                'text' => '<h2>Environmental Alarms Ring Louder</h2>
            <p>Global temperatures have reached record highs, with extreme weather patterns devastating agriculture, ecosystems, and livelihoods. The Intergovernmental Panel on Climate Change warns of irreversible consequences if emissions remain unchecked.</p>
            <blockquote>“This decade is our last chance to prevent catastrophic warming,” said Dr. Lena Hoffmann, UN climate analyst.</blockquote>
            <p>Experts urge nations to commit to net-zero policies, prioritize renewable energy, and strengthen climate resilience at the community level.</p>
        ',
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
                'category_id' => 1,
                'text' => '<h2>Global Tech Scrutiny</h2>
            <p>Major technology companies face unprecedented regulatory pressure. Governments are enforcing new laws demanding greater algorithmic transparency and fair data handling practices.</p>
            <ul>
                <li>The EU expands the scope of its Digital Services Act.</li>
                <li>Asia introduces tighter cross-border data transfer rules.</li>
                <li>U.S. antitrust lawsuits target market monopolies.</li>
            </ul>
            <p>Advocates celebrate the move as a long-overdue step to protect user rights, while critics warn of innovation slowdowns and regulatory overreach.</p>
        ',
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
                'category_id' => 2,
                'text' => '<h2>Entrepreneurship Reignited</h2>
            <p>After years of pandemic disruptions, small businesses are bouncing back stronger. Remote collaboration and digital payment tools have empowered local entrepreneurs to expand globally.</p>
            <p>Investors are particularly optimistic about startups in fintech, logistics, and healthtech sectors across Malaysia, Indonesia, and Thailand.</p>
        ',
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
                'category_id' => 3,
                'text' => '<h2>The Comeback of Live Sports</h2>
            <p>With fans filling stadiums again, global sports revenue is surging. Enhanced broadcasting experiences with multi-angle replays and interactive features bring audiences closer to the action.</p>
            <p>Analysts project record profits for 2025 as fan engagement hits new highs both online and in-person.</p>
        ',
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
                'category_id' => 4,
                'text' => '<h2>Art in the Age of Renewal</h2>
            <p>Global galleries are embracing digital innovation. From 3D-printed sculptures to NFT-based installations, the post-pandemic art world merges physical and virtual experiences to engage diverse audiences.</p>
            <p>Art Basel and Venice Biennale both report record participation, signaling a creative rebirth worldwide.</p>
        ',
            ],
            [
                'title' => 'Hollywood Shock: A-List Couple Announces Split',
                'author' => 'Samantha Reyes',
                'slug' => 'hollywood-shock-couple-split',
                'content' => 'In a surprise announcement, one of Hollywood\'s most admired couples has confirmed their separation after eight years together. Fans flood social media with mixed reactions as sources hint at conflicting career paths as the main reason.',
                'image' => 'img/Red_Carpet_Split_Shock.png',
                'read_minutes' => 3,
                'is_published' => true,
                'published_at' => Carbon::now()->subDay(),
                'category_id' => 4,
                'text' => '<h2>Behind the Glamour</h2>
            <p>The couple cited mutual respect and gratitude in their public statement. Insiders suggest that busy production schedules and differing career ambitions strained the relationship over the years.</p>
            <p>Social media buzzed with nostalgia as fans shared their favorite moments from the pair’s celebrated career collaborations.</p>
        ',
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
                'category_id' => 2,
                'text' => '<h2>Investor Sentiment Surges</h2>
            <p>Equities rallied across Asia and Europe following announcements that interest rate hikes may slow. Analysts noted significant gains in green energy and AI-driven technology firms.</p>
            <p>However, inflation concerns and geopolitical uncertainty continue to cast a shadow on long-term forecasts.</p>
        ',
            ],
            [
                'title' => 'Fashion Week 2025: Bold Colors and Virtual Runways',
                'author' => 'Alicia Gomez',
                'slug' => 'fashion-week-2025-virtual-runways',
                'content' => 'This year\'s Fashion Week stunned audiences as designers merged virtual and physical experiences. Augmented reality and AI-styled collections showcased the future of couture in a post-digital world.',
                'image' => 'img/Future_Fashion_Digital_Runway.png',
                'read_minutes' => 4,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(4),
                'category_id' => 4,
                'text' => '<h2>Virtual Couture Takes Center Stage</h2>
            <p>Designers embraced technology in unprecedented ways. AR fitting rooms and holographic runways blurred the lines between physical and virtual fashion, offering interactive experiences for global audiences.</p>
            <p>Critics praised the creativity, marking 2025 as the most futuristic Fashion Week yet.</p>
        ',
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
                'category_id' => 2,
                'text' => '<h2>Bitcoin Bloodbath</h2>
            <p>Triggered by new crypto regulations in the U.S. and China, Bitcoin experienced its sharpest one-day drop since 2023. Investors fled to bonds and commodities amid heightened uncertainty.</p>
            <p>Analysts advise caution as volatility remains high across digital asset markets.</p>
        ',
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
                'category_id' => 1,
                'text' => '<h2>Corporate Power Struggle</h2>
            <p>New data protection frameworks in Europe and Asia are forcing tech companies to localize servers and audit algorithms. This has triggered disputes between firms over compliance and interoperability.</p>
            <p>Experts expect mergers and partnerships to navigate the evolving landscape.</p>
        ',
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
                'category_id' => 6,
                'text' => '<h2>Energy Markets Under Pressure</h2>
            <p>Escalating tensions have disrupted major oil supply routes, sending global prices soaring. Analysts warn that prolonged instability could fuel inflationary waves across developing economies.</p>
        ',
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
                'category_id' => 7,
                'text' => '<h2>The Quantum Leap in AI</h2>
            <p>Quantum processors have achieved previously impossible speeds in handling parallel computations. AI models can now train in hours instead of days, drastically reducing energy consumption.</p>
            <p>This breakthrough is expected to revolutionize industries including medicine, logistics, and weather prediction.</p>
        ',
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
                'category_id' => 2,
                'text' => '<h2>Cooling Market Trends</h2>
            <p>Mortgage rate hikes are dampening global property demand. Urban housing prices have started to stabilize, signaling potential opportunities for first-time buyers and long-term investors.</p>
        ',
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
                'category_id' => 5,
                'text' => '<h2>Unplug to Recharge</h2>
            <p>Wellness tourism is on the rise, with travelers seeking balance away from constant notifications. Digital detox retreats emphasize meditation, forest therapy, and slow living experiences.</p>
            <p>Health experts endorse the trend as a vital step toward better mental well-being in the hyperconnected era.</p>
        ',
            ],
        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
    }
}
