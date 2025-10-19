<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest news and updates from the tech world',
                'color' => '#3B82F6',
                'is_active' => true,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business news, market updates, and financial insights',
                'color' => '#10B981',
                'is_active' => true,
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'Sports news, match results, and athlete updates',
                'color' => '#F59E0B',
                'is_active' => true,
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Celebrity news, movies, music, and entertainment industry updates',
                'color' => '#EF4444',
                'is_active' => true,
            ],
            [
                'name' => 'Health & Lifestyle',
                'slug' => 'health-lifestyle',
                'description' => 'Health tips, lifestyle trends, and wellness news',
                'color' => '#8B5CF6',
                'is_active' => true,
            ],
            [
                'name' => 'Politics',
                'slug' => 'politics',
                'description' => 'Political news, government updates, and policy changes',
                'color' => '#6B7280',
                'is_active' => true,
            ],
            [
                'name' => 'Science',
                'slug' => 'science',
                'description' => 'Scientific discoveries, research findings, and innovation',
                'color' => '#06B6D4',
                'is_active' => true,
            ],
            [
                'name' => 'Environment',
                'slug' => 'environment',
                'description' => 'Climate change, environmental issues, and sustainability',
                'color' => '#059669',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
