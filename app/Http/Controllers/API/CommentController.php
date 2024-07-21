<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index($taskId)
    {
        $task = Task::findOrFail($taskId);
        $comments = $task->comments()->paginate(10);
        return response()->json($comments);
    }

    public function store(Request $request, $taskId)
    {
        try {
            $task = Task::findOrFail($taskId);

            $validator = Validator::make($request->all(), [
                'comment' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $comment = Comment::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'comment' => $request->comment,
            ]);

            $task->author->notify(new \App\Notifications\TaskCommented($task));

            return response()->json($comment);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found.'], 404);
        }
    }

    public function show($taskId, $commentId)
    {
        try {
            $task = Task::findOrFail($taskId);
            $comment = $task->comments()->findOrFail($commentId);
            return response()->json($comment);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task or comment not found.'], 404);
        }
    }

    public function update(Request $request, $taskId, $commentId)
    {
        try {
            $task = Task::findOrFail($taskId);
            $comment = $task->comments()->where('user_id', Auth::id())->findOrFail($commentId);

            $validator = Validator::make($request->all(), [
                'comment' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $comment->update($request->all());

            return response()->json($comment);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task or comment not found.'], 404);
        }
    }

    public function destroy($taskId, $commentId)
    {
        try {
            $task = Task::findOrFail($taskId);
            $comment = $task->comments()->where('user_id', Auth::id())->findOrFail($commentId);

            $comment->delete();

            return response()->json(['message' => 'Comment deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task or comment not found.'], 404);
        }
    }
}
