<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['title' => 'Закончить отчет', 'description' => 'Подготовить отчет по продажам за март', 'status' => false],
            ['title' => 'Проверить почту', 'description' => 'Ответить на важные письма', 'status' => true],
            ['title' => 'Разработать API', 'description' => 'Создать CRUD API для задач', 'status' => false],
            ['title' => 'Обновить документацию', 'description' => 'Добавить новые эндпоинты в документацию', 'status' => false],
            ['title' => 'Позвонить клиенту', 'description' => 'Обсудить новые условия контракта', 'status' => true],
            ['title' => 'Заказать оборудование', 'description' => 'Купить новый сервер для офиса', 'status' => false],
            ['title' => 'Провести совещание', 'description' => 'Обсудить проект с командой', 'status' => true],
            ['title' => 'Изучить Laravel', 'description' => 'Прочитать документацию по сервис-контейнерам', 'status' => false],
            ['title' => 'Оптимизировать код', 'description' => 'Рефакторинг кода в проекте', 'status' => false],
            ['title' => 'Запланировать отпуск', 'description' => 'Выбрать даты и забронировать билеты', 'status' => true],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }

    }
}
