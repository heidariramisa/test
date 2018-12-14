<?php


use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Todo;
use Illuminate\Http\Request;

class TodoController extends App\Http\Controllers\Controller
{
    public function create(TodoRequest $request)
    {
        try {
            $todo = new Todo();
            $todo->title = $request->input('title');
            $todo->description = $request->input('description');
            $todo->status()->associate($request->input('status'));
            $todo->tasks()->sync($request->input('tasks'));
            $todo->user()->associate(auth()->user());
            return response()->json(['ok' => true,
                'message' => 'todo created successfully',
                'data' => TodoResource::collection($todo)]);
        } catch (Throwable $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()]);
        }
    }


    public function list()
    {
        return response()->json(['ok' => true,
            'message' => 'todo list',
            'data' => TodoResource::collection(Todo::where('user_id', auth()->user()->id)->get())]);
    }

    public function update(Todo $todo, Request $request)
    {

        try {
            if ($request->input('status') == 2) {
                $todo->status()->associate(2);
                $todo->tasks()->status()->associate(2);
                $todo->save();
                return response()->json(['ok' => true, 'message' =>
                    'todo and it`s tasks statuses changed to cancelled']);
            } else {
                $todo->status()->associate($request->input('status'));
                $todo->save();
                return response()->json(['ok' => true, 'message' =>
                    'todo status changed',
                    'data' => new TodoResource($todo)]);
            }
        } catch (Throwable $e) {
            return response()->json(['ok' => 'false', 'message' => $e->getMessage()]);
        }


    }

    public function delete(Todo $todo)
    {
        if ($todo->tasks() == null) {
            $todo->delete();
            return response()->json(['ok' => true]);
        } else {
            return response()->json(['ok' => false, 'message' =>
                'this todo cant be deleted, because it has one or more tasks']);
        }
    }


}