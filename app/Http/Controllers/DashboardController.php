<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Application;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function indexClient()
    {
        $client_id = Auth::id();

        $projects = Project::where('client_id', $client_id)
            ->whereIn('status', ['in progress', 'completed'])
            ->get();

        $openProjects = Project::where('client_id', $client_id)
            ->where('status', 'open')
            ->get();

        $waitingApprovalProjects = Project::where('client_id', $client_id)
            ->where('status', 'waiting approval')
            ->get();

        $inProgressProjects = Project::where('client_id', $client_id)
            ->where('status', 'in progress')
            ->get();

        $completedProjects = Project::where('client_id', $client_id)
            ->where('status', 'completed')
            ->get();

        // Data for Application Line Chart (Monthly)
        $applicationData = [];
        for ($i = 1; $i <= 12; $i++) {
            $applicationData[] = Application::whereHas('project', function ($query) use ($client_id) {
                $query->where('client_id', $client_id);
            })
                ->whereMonth('application_date', $i)
                ->whereYear('application_date', date('Y'))
                ->count();
        }

        return view('layouts.client.dashboard-client', compact(
            'projects',
            'openProjects',
            'waitingApprovalProjects',
            'inProgressProjects',
            'completedProjects',
            'applicationData'
        ));
    }

    public function indexFreelancer()
    {
        $freelancer_id = Auth::id();

        $waitingApplication = Application::where('freelancer_id', $freelancer_id)
            ->where('status', 'waiting')
            ->get();

        $acceptedApplication = Application::where('freelancer_id', $freelancer_id)
            ->where('status', 'accepted')
            ->get();

        $rejectedApplication = Application::where('freelancer_id', $freelancer_id)
            ->where('status', 'rejected')
            ->get();

        // Data for Task Progress Bar Chart
        $labels = ['To-do', 'Process', 'Completed'];
        $data = [
            Task::where('status', 'to-do')
                ->whereHas('project', function ($query) {
                    $query->where('status', 'in progress')
                        ->where('freelancer_id', Auth::id());
                })
                ->count(),

            Task::where('status', 'process')
                ->whereHas('project', function ($query) {
                    $query->where('status', 'in progress')
                        ->where('freelancer_id', Auth::id());
                })
                ->count(),

            Task::where('status', 'completed')
                ->whereHas('project', function ($query) {
                    $query->where('status', 'in progress')
                        ->where('freelancer_id', Auth::id());
                })
                ->count(),
        ];

        // Data for Income Line Chart
        $incomeData = [];
        for ($i = 1; $i <= 12; $i++) {
            $incomeData[] = Project::where('freelancer_id', $freelancer_id)
                ->where('status', 'completed')
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y'))
                ->sum('budget');
        }


        $projects = Project::where('freelancer_id', $freelancer_id)
            ->whereIn('status', ['in progress', 'completed'])
            ->get();

        return view('layouts.freelancer.dashboard-freelancer', compact(
            'freelancer_id',
            'waitingApplication',
            'acceptedApplication',
            'rejectedApplication',
            'labels',
            'data',
            'incomeData',
            'projects'
        ));
    }

}
