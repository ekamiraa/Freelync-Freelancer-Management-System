<?php

namespace App\Http\Controllers;

use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($project_id, $task_id)
    {

        $project = Project::findOrFail($project_id);

        $task = Task::findOrFail($task_id);

        $comments = Comment::where('task_id', $task->id)
            ->with(['client', 'freelancer']) // get data client and freelancer
            ->get();

        return view('layouts.both.comment', compact('project', 'task', 'comments'));
    }

    public function store(Request $request, $project_id, $task_id)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:255'
        ]);

        $project = Project::findOrFail($project_id);

        $task = Task::findOrFail($task_id);

        if (auth()->user()->hasRole('client')) {

            $comment = Comment::create([
                'task_id' => $task_id,
                'client_id' => Auth::id(),
                'comment' => $validated['comment'],
                'date' => now()
            ]);

        } elseif (auth()->user()->hasRole('freelancer')) {

            $comment = Comment::create([
                'task_id' => $task_id,
                'freelancer_id' => Auth::id(),
                'comment' => $validated['comment'],
                'date' => now()

            ]);

        }


        // Send an acceptance notification with custom message
        $projectTitle = $task->project->title;
        $taskDesc = $task->desc;
        $commentDesc = $comment->comment;
        $statusMessage = "You have commented on the task '{$taskDesc}' of the project '{$projectTitle}': '{$commentDesc}'";

        // Send Notification
        if (auth()->user()->hasRole('client')) {

            $project->freelancer->notify(new CommentNotification($comment, $statusMessage));

        } elseif (auth()->user()->hasRole('freelancer')) {

            $project->client->notify(new CommentNotification($comment, $statusMessage));

        }

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
