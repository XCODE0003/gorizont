<?php

namespace Database\Factories;

use App\Models\Articles;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Устанавливаем русскую локализацию для Faker
        $this->faker = \Faker\Factory::create('ru_RU');

        $themes = ['технологии', 'природа', 'архитектура', 'бизнес', 'путешествия', 'еда', 'спорт', 'люди'];
        $randomTheme = $this->faker->randomElement($themes);

        // Улучшенные изображения с конкретной тематикой для более релевантных картинок
        $images = [
            // Красивые, высококачественные тематические изображения
            "https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Технологии
            "https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Природа
            "https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Работа за компьютером
            "https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Городской пейзаж
            "https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Архитектура
            "https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Кафе/ресторан
            "https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Еда
            "https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Еда 2
            "https://images.unsplash.com/photo-1539635278303-d4002c07eae3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Путешествия
            "https://images.unsplash.com/photo-1528543606781-2f6e6857f318?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Природа/отдых
            "https://images.unsplash.com/photo-1507608616759-54f48f0af0ee?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Город/путешествие
            "https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Разработка
            "https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80", // Бизнес/команда
            // Динамические изображения с конкретными тематиками
            "https://source.unsplash.com/1200x800/?{$randomTheme},article"
        ];

        // Варианты русскоязычных заголовков для более осмысленного контента
        $titlePrefixes = [
            'Как', 'Почему', 'Топ-10', '5 способов', 'Лучшие практики', 'Обзор', 'Секреты', 'Будущее',
            'Интересные факты о', 'История', 'Мир', 'Тренды', 'Новый взгляд на', 'Революция в',
            'Исследование', 'Технологии', 'Эволюция', 'Прорыв в', 'Искусство'
        ];

        $titleThemes = [
            'технологиях', 'программировании', 'дизайне', 'бизнесе', 'маркетинге', 'образовании',
            'путешествиях', 'здоровье', 'науке', 'искусстве', 'спорте', 'культуре', 'природе',
            'психологии', 'самосовершенствовании', 'инновациях', 'архитектуре', 'фотографии'
        ];

        // Генерация более осмысленного заголовка
        if (rand(0, 1)) {
            $title = $this->faker->randomElement($titlePrefixes) . ' ' . $this->faker->randomElement($titleThemes);
        } else {
            $title = $this->faker->realText(rand(30, 60));
        }

        // Генерация содержимого статьи на русском
        $paragraphs = [];
        $paragraphCount = rand(3, 7);
        for ($i = 0; $i < $paragraphCount; $i++) {
            $paragraphs[] = $this->faker->realText(rand(200, 500));
        }
        $content = implode("\n\n", $paragraphs);

        return [
            'title' => $title,
            'content' => $content,
            'image' => $this->faker->randomElement($images),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'comment' => (bool)rand(0, 1),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Создание статьи с указанным пользователем
     */
    public function forUser(User $user)
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }

    /**
     * Создание статьи с указанной категорией
     */
    public function inCategory(Category $category)
    {
        return $this->state(function (array $attributes) use ($category) {
            return [
                'category_id' => $category->id,
            ];
        });
    }
}