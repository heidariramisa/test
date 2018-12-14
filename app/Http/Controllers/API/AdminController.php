<?php

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Task;
use App\Todo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function list()
    {
        try {
            return response()->json(['ok' => true, 'message' =>
                'task created successfully',
                'data' => UserResource::collection(User::all())]);
        } catch (Throwable $e) {
            return response()->json(['ok' => false, 'message' =>
                $e->getMessage()]);
        }
    }

    public function verify(User $user)
    {
        try {
            $user->email_verified_at=\Carbon\Carbon::now();
            $user->save();
            return response()->json(['ok' => true, 'message' =>
                'user actived successfully',
                'data' => new TaskResource($user)]);
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