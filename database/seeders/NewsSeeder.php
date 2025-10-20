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
                    <p>Artificial intelligence is reshaping education at every level. From primary classrooms to postgraduate research, adaptive systems now tailor lessons to each student’s pace and ability.</p>

                    <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-700 my-4">
                        “AI doesn’t replace teachers—it empowers them,” said Dr. Maria Lang, an education technology expert at Oxford University.
                    </blockquote>

                    <p>Virtual tutors powered by AI are helping students overcome learning gaps in mathematics and languages. Automated grading tools are giving teachers back precious hours, while data-driven insights identify struggling students before it’s too late.</p>

                    <p>Analysts predict that by 2030, over half of global schools will integrate AI-driven learning systems, creating more equitable access to education regardless of geography or income level.</p>
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
                    <p>The world is feeling the heat—literally. Global average temperatures have soared to historic highs, melting glaciers at record speed and triggering devastating floods across Asia and Europe.</p>

                    <blockquote class="border-l-4 border-green-500 pl-4 italic text-gray-700 my-4">
                        “This decade is our last chance to prevent catastrophic warming,” warned Dr. Lena Hoffmann, UN climate analyst.
                    </blockquote>

                    <p>From prolonged droughts in Africa to intense hurricanes in the Atlantic, the signs are unmistakable: climate change is no longer a prediction—it’s reality. Agriculture, coastal communities, and biodiversity are all under threat.</p>

                    <p>Experts urge governments to prioritize renewable energy adoption, invest in carbon capture technologies, and support vulnerable nations adapting to the crisis. The window for action is closing fast.</p>
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
                    <p>Regulators across the world are turning up the heat on major technology firms, enforcing a wave of new compliance measures. Governments now demand algorithmic transparency, fair competition, and stronger user data protection.</p>

                    <ul class="list-disc list-inside text-gray-700 my-4">
                        <li><strong>European Union:</strong> Expands the <em>Digital Services Act</em> to curb disinformation and strengthen consumer rights.</li>
                        <li><strong>Asia-Pacific:</strong> Introduces tighter cross-border data transfer laws to safeguard national digital sovereignty.</li>
                        <li><strong>United States:</strong> Faces mounting antitrust battles aimed at breaking up entrenched tech monopolies.</li>
                    </ul>

                    <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-700 my-6">
                        “This is the most coordinated global effort to rein in big tech in over a decade,” said <strong>Dr. Lina Morales</strong>, a policy analyst at the Global Digital Governance Institute.
                    </blockquote>

                    <p>While privacy advocates hail these efforts as a long-awaited victory for user rights, industry leaders warn that excessive red tape could stifle innovation and slow global technological growth.</p>
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
                    <p>After years of pandemic disruptions, small businesses are staging a remarkable comeback. The rise of remote collaboration tools and digital payment platforms has empowered local entrepreneurs to reach customers far beyond their borders.</p>

                    <blockquote class="border-l-4 border-yellow-500 pl-4 italic text-gray-700 my-6">
                        “Innovation thrives when resilience meets opportunity,” said <strong>Farah Rahman</strong>, a Southeast Asian startup mentor. “Entrepreneurs are rebuilding stronger and smarter than ever before.”
                    </blockquote>

                    <p>Investors are showing renewed confidence in the region, particularly in <strong>fintech</strong>, <strong>logistics</strong>, and <strong>healthtech</strong> startups across <strong>Malaysia</strong>, <strong>Indonesia</strong>, and <strong>Thailand</strong>. Analysts forecast sustained growth as these emerging markets continue to embrace digital transformation.</p>
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
                    <p>Stadiums are roaring once again as fans return in full force, marking a powerful revival for the global sports industry. The renewed energy has fueled ticket sales, merchandise demand, and broadcast partnerships worldwide.</p>

                    <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-700 my-6">
                        “Live sports remind us of our shared spirit — the thrill, the unity, and the emotion that can’t be streamed,” said <strong>James Porter</strong>, a senior sports economist.
                    </blockquote>

                    <p>Advancements in streaming technology, including <strong>multi-angle replays</strong> and <strong>interactive fan features</strong>, are redefining the viewer experience. Analysts predict record-breaking profits in 2025 as fan engagement reaches unprecedented levels — both online and in stadiums worldwide.</p>
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
                    <p>The global art scene is experiencing a renaissance as galleries and creators blend tradition with technology. From <strong>3D-printed sculptures</strong> to <strong>NFT-driven installations</strong>, artists are redefining how audiences connect with creativity in both physical and virtual spaces.</p>

                    <blockquote class="border-l-4 border-purple-500 pl-4 italic text-gray-700 my-6">
                        “Art is no longer confined to walls — it lives in pixels, sound, and shared experience,” remarked <strong>Elena Petrov</strong>, curator at the Global Art Symposium.
                    </blockquote>

                    <p>Major events like <strong>Art Basel</strong> and the <strong>Venice Biennale</strong> report record-breaking participation, signaling a powerful cultural rebirth fueled by resilience, innovation, and global collaboration.</p>
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
                    <p>In their heartfelt statement, the couple expressed <strong>mutual respect and lasting gratitude</strong> for the years they shared both on and off screen. Yet, sources close to the duo hint that relentless production schedules and diverging career paths gradually created distance between them.</p>

                    <blockquote class="border-l-4 border-pink-500 pl-4 italic text-gray-700 my-6">
                        “Fame brought them together — but ambition pulled them apart,” revealed an industry insider familiar with their journey.
                    </blockquote>

                    <p>Across social media, fans flooded timelines with nostalgic tributes, sharing clips and behind-the-scenes photos from the couple’s most iconic collaborations — a bittersweet reminder of Hollywood’s fragile magic.</p>
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
                    <p>Global markets roared back to life today after central banks hinted at easing monetary policies. The move sparked rallies in major indices, with technology and clean energy stocks leading the surge.</p>

                    <blockquote class="border-l-4 border-yellow-500 pl-4 italic text-gray-700 my-4">
                        “Markets are breathing again after months of uncertainty,” said Helen Lau, a senior economist at Bloomberg Asia.
                    </blockquote>

                    <p>Analysts say this pivot could mark a turning point after two years of aggressive rate hikes aimed at cooling inflation. However, some warn that premature optimism may fuel speculative bubbles in volatile sectors.</p>

                    <p>Despite short-term enthusiasm, economic fundamentals remain fragile, and geopolitical tensions could easily shift investor sentiment once again.</p>
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
                    <p>Global cryptocurrency markets were rattled as Bitcoin plunged over 18% in a single day — its steepest decline since 2023. The sell-off followed fresh regulatory crackdowns in the U.S. and China, sparking a wave of panic across major exchanges.</p>

                    <blockquote class="border-l-4 border-red-500 pl-4 italic text-gray-700 my-4">
                        “The new compliance mandates have created shockwaves. Traders are unwinding positions faster than anticipated,” said market strategist Alex Ong.
                    </blockquote>

                    <p>Investors rushed to safer assets such as bonds, gold, and energy futures, while altcoins mirrored the downturn. Analysts warn that volatility will remain elevated until clearer global frameworks for digital assets emerge.</p>
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
                    <p>Tech giants are clashing as new data protection laws in Europe and Asia compel companies to localize servers, strengthen encryption, and open algorithms to regulatory audits. The compliance race has sparked fierce competition over cloud infrastructure and cross-border data control.</p>

                    <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-700 my-4">
                        “We’re witnessing a digital sovereignty battle — where compliance is becoming a tool of market dominance,” said policy analyst Dr. Mei Tan.
                    </blockquote>

                    <p>As governments tighten oversight, companies are pursuing strategic mergers and partnerships to share compliance costs and maintain global interoperability. Industry observers warn that this could reshape the balance of power among the world’s largest tech ecosystems.</p>
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
                    <p>Escalating geopolitical tensions have disrupted vital oil supply routes, sending global crude prices surging to their highest levels in months. The ripple effects are already being felt across international markets, from transportation costs to food production.</p>

                    <blockquote class="border-l-4 border-yellow-500 pl-4 italic text-gray-700 my-4">
                        “Every spike in oil prices has a domino effect on inflation and consumer confidence,” noted economist Ahmed Saleh. “Developing nations will bear the brunt if instability continues.”
                    </blockquote>

                    <p>Governments are now racing to secure alternative energy sources and stabilize fuel reserves as uncertainty looms. Analysts caution that prolonged volatility could intensify global inflation and delay post-pandemic economic recovery.</p>

                    <p>Meanwhile, renewable energy advocates see this as a wake-up call to accelerate the shift toward sustainable and locally sourced energy solutions.</p>
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
                    <p>Quantum processors have shattered previous computational limits, performing calculations at speeds once thought impossible. By manipulating qubits instead of traditional bits, these next-generation systems can process vast datasets with unprecedented efficiency.</p>

                    <blockquote class="border-l-4 border-purple-500 pl-4 italic text-gray-700 my-4">
                        “This is not just a step forward — it’s a paradigm shift. We are entering the era where AI learns faster than ever before,” said Dr. Isaac Nolan, lead researcher at QuantumTech Labs.
                    </blockquote>

                    <p>AI models that once required days of training can now be completed in a matter of hours, drastically reducing energy consumption and accelerating innovation. Industries from <strong>healthcare diagnostics</strong> to <strong>climate modeling</strong> are poised to benefit.</p>

                    <p>Analysts predict that as commercial quantum computing matures, it will redefine the competitive edge in global technology, marking the dawn of a truly intelligent digital age.</p>
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
                    <p>After years of rapid growth, the global housing market is finally showing signs of cooling. Rising interest rates and tighter lending policies are pushing many potential buyers to the sidelines, leading to slower price appreciation across major cities.</p>

                    <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-700 my-4">
                        “The market is entering a phase of healthy correction — not a crash, but a recalibration,” noted economist Dr. Rebecca Lim of Global Finance Watch.
                    </blockquote>

                    <p>In regions like North America and Southeast Asia, real estate listings are staying active longer, giving first-time buyers more bargaining power. Analysts expect the trend to continue into 2026, with moderate price adjustments creating openings for long-term investors.</p>

                    <p>While developers tighten their budgets and reassess project timelines, experts agree that this slowdown could bring long-overdue balance to the global property sector.</p>
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
                    <p>In an era dominated by screens and constant notifications, more people are escaping to digital detox retreats—remote sanctuaries where Wi-Fi is minimal, and mindfulness takes center stage. From Bali’s tranquil rice terraces to cabins in the Swiss Alps, travelers are rediscovering the art of slowing down.</p>

                    <blockquote class="border-l-4 border-green-500 pl-4 italic text-gray-700 my-4">
                        “When people disconnect from their devices, they reconnect with themselves,” said Dr. Aisha Noor, a wellness psychologist specializing in digital addiction recovery.
                    </blockquote>

                    <p>These retreats offer guided meditation, forest bathing, and holistic therapies designed to heal the mind from information overload. Participants often report improved sleep, reduced anxiety, and a renewed sense of clarity after just a few days offline.</p>

                    <p>As modern life grows increasingly digital, the global wellness industry predicts a 40% rise in demand for ‘unplugged travel’ experiences by 2026—making disconnection the newest form of luxury.</p>
                ',
            ],
            [
                'title' => 'Tragic Plane Crash Claims 162 Lives Off Indonesian Coast',
                'author' => 'Farid Hassan',
                'slug' => 'indonesia-plane-crash-2025',
                'content' => 'A passenger aircraft carrying 162 people has crashed into the sea off the coast of Indonesia. Rescue operations are underway amid challenging weather conditions. Authorities have confirmed several survivors, while international teams are offering assistance in recovery efforts.',
                'image' => 'img/Tragic_Plane_Crash_Lives_Off_Indonesian_Coast.png',
                'read_minutes' => 5,
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(9),
                'category_id' => 9,
                'text' => '<h2>Indonesia Mourns After Major Air Tragedy</h2>
                    <p>Authorities in Indonesia have confirmed that a commercial aircraft with <strong>162 passengers and crew</strong> on board went down in the Java Sea earlier today. The cause of the crash remains under investigation.</p>

                    <p>Eyewitnesses reported seeing the plane lose altitude rapidly before disappearing from radar screens. The flight, operated by a regional airline, was en route from Jakarta to Manado when it lost contact approximately 40 minutes after takeoff.</p>

                    <p>Rescue operations began immediately, with <strong>naval and coast guard units</strong> deploying helicopters, ships, and divers to the crash site. Heavy rain and rough seas are hampering progress, but several survivors have been pulled from the water.</p>

                    <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-700 my-4">
                        “Our hearts are with the families of all victims. Every effort is being made to recover survivors and investigate what happened,” said Indonesia’s Transport Minister.
                    </blockquote>

                    <p>Experts from multiple countries, including Singapore, Australia, and Japan, have offered technical assistance with the <strong>flight data recorder analysis</strong>. Early reports suggest possible mechanical failure or severe weather interference.</p>

                    <p>The incident marks one of the worst aviation disasters in recent years for the region, reigniting global discussions about air safety standards and aircraft maintenance protocols.</p>
                ',
            ],

        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
    }
}
