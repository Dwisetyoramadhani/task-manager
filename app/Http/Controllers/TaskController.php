<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    protected $task;

    public function __construct(TaskService $task)
    {
        $this->task = $task;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = $this->task->getAll();
        return response()->json([
            'status' => 'Success',
            'data' => TaskResource::collection($task)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {

        $data = $request->validated();

        $data['user_id'] = auth()->id();

        $task = $this->task->create($data);

        return response()->json([
            'message' => 'Task created',
            'data' => new TaskResource($task)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json($this->task->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            $data = $request->validated();
            if (empty($data)) {
                return response()->json([
                    'message' => 'No data provided'
                ], 400);
            }
            $task = $this->task->update($data, $id);
            return response()->json([
                'message' => 'Task updated',
                'data' => new TaskResource($task)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->task->delete($id));
    }
}
