<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\Response;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Task API",
 *     description="API для управления задачами",
 *     @OA\Contact(
 *         email="support@example.com"
 *     )
 * )
 *
 * @OA\Tag(
 *     name="Tasks",
 *     description="API для работы с задачами"
 * )
 *
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="ID задачи"),
 *     @OA\Property(property="title", type="string", description="Заголовок задачи"),
 *     @OA\Property(property="description", type="string", description="Описание задачи"),
 *     @OA\Property(property="status", type="boolean", description="Статус задачи (завершена или нет)"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Дата создания задачи"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Дата обновления задачи")
 * )
 *
 * @OA\Schema(
 *     schema="TaskRequest",
 *     type="object",
 *     @OA\Property(property="title", type="string", description="Заголовок задачи", example="New Task"),
 *     @OA\Property(property="description", type="string", description="Описание задачи", example="Description of the task"),
 *     @OA\Property(property="status", type="boolean", description="Статус задачи", example=false)
 * )
 */
class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Получить список задач",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="Список задач",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Task"))
     *     )
     * )
     */
    public function index()
    {
        return TaskResource::collection($this->service->getAllTasks());
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Создать задачу",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Созданная задача",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     */
    public function store(TaskRequest $request)
    {
        return new TaskResource($this->service->createTask($request->validated()));
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     summary="Получить одну задачу",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Детали задачи",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     */
    public function show($id)
    {
        $task = $this->service->getTaskById($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        return new TaskResource($task);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     summary="Обновить задачу",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Обновленная задача",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     */
    public function update(TaskRequest $request, $id)
    {
        $task = $this->service->getTaskById($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        return new TaskResource($this->service->updateTask($task, $request->validated()));
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     summary="Удалить задачу",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Задача удалена"
     *     )
     * )
     */
    public function destroy($id)
    {
        $task = $this->service->getTaskById($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        $this->service->deleteTask($task);
        return response()->json(['message' => 'Task deleted'], Response::HTTP_NO_CONTENT);

    }
}
