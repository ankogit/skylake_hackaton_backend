<?php

namespace Database\Seeders;

use App\Models\SurveyCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SurveyCategory::query()->insert([
            [
                'name' => "Физическое"
            ],
            [
                'name' => "Эмоциональное"
            ],
            [
                'name' => "Финансовое"
            ],
            [
                'name' => "Социальное"
            ],
            [
                'name' => "Профессиональное"
            ],
            [
                'name' => "Предназначение"
            ],
            [
                'name' => "Интеллектуальное"
            ],
            [
                'name' => "Окружающая среда"
            ],
        ]);
    }
}
