<?php


use App\Http\Requests\TodoRequest;
use App\Http\Resources\TaskResource;
use App\Task;
use App\Todo;
use Illuminate\Http\Request;

class TaskController extends App\Http\Controllers\Controller
{
    public function create(TodoRequest $request, Todo $todo)
    {
        try {

            $task = new Task();
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->todo()->associate($todo);
            $task->status()->associate($request->input('status'));
            $task->save();
            return response()->json(['ok' => true, 'message' =>
                'task created successfully',
                'data' => new TaskResource($task)]);
        } catch (Throwable $e) {
            return response()->json(['ok' => false, 'message' =>
                $e->getMessage()]);
        }
    }

    public function update(Task $task, Request $request)
    {
        try {
            $status = $request->input('status');
            if ($status == 1) {
                $task->todo()->status()->associate($status);
            }
            $task->status()->associate($status);
            $task->save();
            return response()->json(['ok' => true, 'message' =>
                'task status changed successfully',
                'data' => new TaskResource($task)]);
        } catch (Throwable $e) {
            return response()->json(['ok' => false, 'message' =>
                $e->getMessage()]);
        }

    }

    public function delete(Task $task)
    {
        try {
            $task->delete();
            return response()->json(['ok' => true, 'message' =>
                'task deleted successfully']);
        } catch (Throwable $e) {
            return response()->json(['ok' => false, 'message' =>
                $e->getMessage()]);
        }

    }
}