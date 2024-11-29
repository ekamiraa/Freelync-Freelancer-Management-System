<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApplicationStatusNotification;
use App\Notifications\ProjectStatusNotification;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    public function applyForProject($project_id)
    {
        $freelancer_id = Auth::id();

        // Check if the freelancer has already applied for the project
        $existingApplication = Application::where('project_id', $project_id)
            ->where('freelancer_id', $freelancer_id)
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this project.');
        }

        // Update the status of the project
        $project = Project::findOrFail($project_id);

        // Only update the status and send notification if it's not already in "waiting approval"
        if ($project->status != 'waiting approval') {
            $project->status = 'waiting approval';
            $project->save();

            // Send notification update status project to client
            $message = "Update Status Project: Your project '{$project->title}' is now {$project->status}";
            $project->client->notify(new ProjectStatusNotification($project, $message));
        }

        // Create a new application
        $application = Application::create([
            'project_id' => $project_id,
            'freelancer_id' => $freelancer_id,
            'application_date' => now(),
            'status' => 'waiting'
        ]);

        // Get project title and application date from the newly created application
        $projectTitle = $application->project->title;
        $applicationDate = Carbon::parse($application->application_date)->format('l, d F Y H:i');
        $statusMessage = "Your application for the project '{$projectTitle}' on {$applicationDate} has been successfully submitted.";

        // Send notification to the freelancer (authenticated user)
        auth()->user()->notify(new ApplicationStatusNotification($application, $statusMessage));

        // Redirect with success message
        return redirect()->back()->with('success', 'You have successfully applied for this project.');
    }

    public function chooseFreelancer($project_id, $application_id)
    {

        // Update status of application
        $application = Application::findOrFail($application_id);
        $application->status = 'accepted';
        $application->save();

        // Assign the selected freelancer to the project
        $project = Project::findOrFail($project_id);
        $project->freelancer_id = $application->freelancer_id;
        $project->status = 'in progress';
        $project->save();

        // Set other applications' statuses to 'rejected'
        $rejectedApplications = Application::where('project_id', $project_id)
            ->where('id', '!=', $application_id)
            ->get();

        foreach ($rejectedApplications as $rejectedApp) {
            $rejectedApp->status = 'rejected';
            $rejectedApp->save();

            // Send a rejection notification with custom message
            $projectTitle = $rejectedApp->project->title;
            $applicationDate = Carbon::parse($rejectedApp->application_date)->format('l, d F Y H:i');
            $statusMessage = "Your application in '{$projectTitle}' at {$applicationDate} has been rejected.";
            $rejectedApp->freelancer->notify(new ApplicationStatusNotification($rejectedApp, $statusMessage));
        }

        // Send an acceptance notification with custom message
        $projectTitle = $application->project->title;
        $applicationDate = Carbon::parse($application->application_date)->format('l, d F Y H:i');
        $statusMessage = "Your application in '{$projectTitle}' at {$applicationDate} has been accepted.";

        // Send notification to freelancer
        $application->freelancer->notify(new ApplicationStatusNotification($application, $statusMessage));

        // Send notification status project to client 
        $message = "Update Status Project: Your project '{$project->title}' is now {$project->status}";
        $project->client->notify(new ProjectStatusNotification($project, $message));

        return redirect()->route('client.waiting-approval-project', $project_id)->with('success', 'Freelancer chosen successfully.');
    }

    public function waitingApprovalProject()
    {
        // Ambil project berdasarkan id client
        $client_id = Auth::id();

        $waitingApprovalProjects = Project::where('client_id', $client_id)
            ->where('status', 'waiting approval')
            ->latest()
            ->paginate(12);

        return view('layouts.client.waiting-approval-project', compact('waitingApprovalProjects'));
    }

    public function showApplication($project_id)
    {
        $project = Project::findOrFail($project_id);

        $applications = Application::where('project_id', $project_id)
            ->latest()
            ->paginate(25);

        return view('layouts.client.application', compact('applications', 'project'));
    }

}
