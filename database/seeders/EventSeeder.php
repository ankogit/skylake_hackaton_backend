<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\Lector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->create([
            'name' => "Психология"
        ]);
        Lector::query()->create([
            'first_name' => "Зоя",
            'last_name' => "Алексеевна",
            'info' => "Преподаватель по медитации",
            'description' => 'На лекции будет особое внимание уделено стратегиям профилактики выгорания, а также методам преодоления этого состояния. Вы узнаете о важности управления стрессом, поддержке психического здоровья и развитии навыков эмоциональной стойкости для предотвращения выгорания как в личной, так и в профессиональной жизни.',
            'contact_email' => 'meditation@gmail.com',
            'contact_telegram' => '@meditation',
        ]);
        Event::factory()->count(20)->create();
    }
}
