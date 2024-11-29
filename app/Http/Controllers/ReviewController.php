<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {

        if (auth()->user()->hasRole('client')) {

            $reviews = Review::where('client_id', Auth::id())->get();

        } elseif (auth()->user()->hasRole('freelancer')) {

            $reviews = Review::whereHas('project', function ($query) {
                $query->where('freelancer_id', Auth::id());
            })->get();

        }

        return view('layouts.both.review', compact('reviews'));
    }

    // View Create Task
    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);

        return view('layouts.client.create-review', compact('project'));
    }


    // Create Task
    public function store(Request $request, $project_id)
    {
        Project::findOrFail($project_id);

        $validated = $request->validate([
            'review' => 'required|string|max:255',
        ]);

        $review = Review::create([
            'project_id' => $project_id,
            'client_id' => Auth::id(),
            'review' => $validated['review'],
            'date' => now()
        ]);

        $review->save();

        return redirect()->route('review', $project_id)->with('success', 'Review created successfully.');
    }

    // View Update Task
    public function edit($project_id, $review_id)
    {
        $project = Project::findOrFail($project_id);

        $review = Review::findOrFail($review_id);

        return view('layouts.client.update-review', compact('project', 'review'));
    }

    // Update Task
    public function update(Request $request, $project_id, $review_id)
    {

        $review = Review::findOrFail($review_id);

        $validated = $request->validate([
            'review' => 'required',
            'date' => now()
        ]);

        $review->update([
            'review' => $validated['review'],
            'date' => now()
        ]);

        return redirect()->route('review', [$project_id, $review_id])->with('success', 'Review updated successfully.');
    }


    // Delete Task
    public function destroy($project_id, $review_id)
    {
        //$project = Project::findOrFail($project_id);

        $review = Review::findOrFail($review_id);

        $review->delete();

        return redirect()->route('review', [$project_id, $review_id])->with('success', 'Review deleted successfully.');
    }
}
