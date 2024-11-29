<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ProjectStatusNotification;

class ProjectController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('role:freelancer')->only(['showAll', 'showByCategory', 'showBySearch', 'showProjectDetail']);
    //     $this->middleware('role:client')->only(['clientProject', 'createProject', 'editProject', 'updateProject', 'deleteProject']);
    // }


    /* -------Freelancer-------*/
    public function showByCategory($id)
    {

        $categories = Category::all();

        $selectedCategory = Category::findOrFail($id);

        $projects = $selectedCategory->projects()
            ->whereIn('status', ['open', 'waiting approval'])
            ->latest()
            ->paginate(12);

        return view('layouts.freelancer.search-project', compact('projects', 'categories', 'selectedCategory'));
    }

    public function show(Request $request)
    {
        $categories = Category::all();
        $keyword = $request->input('keyword');

        $projects = Project::where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%")
                ->orWhere('desc', 'like', "%$keyword%")
                ->orWhere('budget', 'like', "%$keyword%")
                ->orWhereHas('client', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                });
        })
            ->whereIn('status', ['open', 'waiting approval'])  // Tambahkan ini untuk filter status
            ->latest()
            ->paginate(12);

        return view('layouts.freelancer.search-project', compact('projects', 'keyword', 'categories'));
    }

    public function freelancerProject()
    {
        $freelancer = Auth::id();

        $projects = Project::where('freelancer_id', $freelancer)
            ->where('status', 'in progress')
            ->latest()
            ->paginate(12);

        $completedProjects = Project::where('freelancer_id', $freelancer)
            ->where('status', 'completed')
            ->latest()
            ->paginate(12);

        return view('layouts.freelancer.project', compact('freelancer', 'projects', 'completedProjects'));
    }


    /* -------Client-------*/

    public function clientProject()
    {
        // Ambil project berdasarkan id client
        $client_id = Auth::id();

        // Display client's own projects by status
        $openProjects = Project::where('client_id', $client_id)
            ->where('status', 'open')
            ->latest()
            ->paginate(12);

        $waitingApprovalProjects = Project::where('client_id', $client_id)
            ->where('status', 'waiting approval')
            ->latest()
            ->paginate(12);

        $inProgressProjects = Project::where('client_id', $client_id)
            ->where('status', 'in progress')
            ->latest()
            ->paginate(12);

        $completedProjects = Project::where('client_id', $client_id)
            ->where('status', 'completed')
            ->latest()
            ->paginate(12);

        return view('layouts.client.my-project', compact('openProjects', 'waitingApprovalProjects', 'inProgressProjects', 'completedProjects', 'client_id'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('layouts.client.create-project', compact('categories'));
    }

    // Menyimpan proyek baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'desc' => 'required',
            'budget' => 'required|numeric',
            'deadline' => 'required|date',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
        ]);

        $project = Project::create([
            'client_id' => Auth::id(),
            'title' => $validated['title'],
            'desc' => $validated['desc'],
            'budget' => $validated['budget'],
            'deadline' => $validated['deadline'],
            'status' => 'open',
        ]);

        // Simpan kategori yang dipilih ke tabel pivot
        $project->categories()->sync($validated['category_id']);

        // Send notification update status project to client
        $message = "Update Status Project: Your project '{$project->title}' is now {$project->status}";
        $project->client->notify(new ProjectStatusNotification($project, $message));

        return redirect()->route('client.my-projects')->with('success', 'Project created successfully!');
    }

    public function edit($id)
    {
        $categories = Category::all();

        $project = Project::where('client_id', Auth::id())->findOrFail($id);

        return view('layouts.client.update-project', compact('categories', 'project'));
    }


    // Update an existing project
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'desc' => 'required',
            'budget' => 'required|numeric',
            'deadline' => 'required|date',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
        ]);

        $project = Project::findOrFail($id);
        $project->update([
            'title' => $validated['title'],
            'desc' => $validated['desc'],
            'budget' => $validated['budget'],
            'deadline' => $validated['deadline'],
        ]);

        // Update categories (sync the pivot table)
        $project->categories()->sync($validated['category_id']);

        return redirect()->route('client.my-projects')->with('success', 'Project updated successfully!');
    }

    // Delete a project
    public function destroy($id)
    {
        $project = Project::where('client_id', Auth::id())->findOrFail($id);
        $project->delete();

        return redirect()->route('client.my-projects')->with('success', 'Project deleted successfully!');
    }


    public function completedProject($project_id)
    {
        $project = Project::findOrFail($project_id);

        $project->status = 'completed';
        $project->save();

        // Send notification update status project to client
        $message = "Update Status Project: Your project '{$project->title}' is now {$project->status}";
        $project->client->notify(new ProjectStatusNotification($project, $message));

        return redirect()->route('client.create-review', $project_id)->with('success', 'Project completed.');
    }


    /* -------Freelancer and Client-------*/
    public function showProjectDetail($id)
    {
        $project = Project::with('client')->findOrFail($id);

        return view('layouts.both.detail-project', compact('project'));
    }


}
