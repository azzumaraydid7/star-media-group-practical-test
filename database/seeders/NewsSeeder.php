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
        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
    }
}
