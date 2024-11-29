<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index($project_id)
    {
        $project = Project::findOrFail($project_id);

        // Check if the authenticated user is either the client or the freelancer of the project
        if ($project->client_id !== Auth::id() && $project->freelancer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $tasks = $project->tasks;

        return view('layouts.both.task', compact('tasks', 'project'));
    }

    // View Create Task
    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);

        return view('layouts.freelancer.create-task', compact('project'));
    }


    // Create Task
    public function store(Request $request, $project_id)
    {
        Project::findOrFail($project_id);

        $validated = $request->validate([
            'desc' => 'required|max:255',
            'status' => 'required',
        ]);

        Task::create([
            'project_id' => $project_id,
            'desc' => $validated['desc'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('task', $project_id)->with('success', 'Task created successfully.');
    }

    // View Update Task
    public function edit($project_id, $task_id)
    {
        $project = Project::findOrFail($project_id);

        $task = Task::findOrFail($task_id);

        return view('layouts.freelancer.update-task', compact('task', 'project'));
    }

    // Update Task
    public function update(Request $request, $project_id, $task_id)
    {
        $project = Project::findOrFail($project_id);

        $task = Task::findOrFail($task_id);

        $validated = $request->validate([
            'desc' => 'required|max:255',
            'status' => 'required',
        ]);

        $task->update([
            'desc' => $validated['desc'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('task', [$project_id, $task_id])->with('success', 'Task updated successfully.');
    }


    // Delete Task
    public function destroy($project_id, $task_id)
    {
        $project = Project::findOrFail($project_id);

        $task = Task::findOrFail($task_id);

        $task->delete();

        return redirect()->route('task', [$project_id, $task_id])->with('success', 'Task deleted successfully.');
    }

}
