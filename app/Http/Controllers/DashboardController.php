<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $query = JobPosting::query();
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('company_name', 'like', '%' . $request->search . '%');
        }

        $jobs = $query->paginate(2)->through(fn($job) => [
            'id' => $job->id,
            'title' => $job->title,
            'logo' => asset('storage/' . $job->logo),
            'company_name' => $job->company_name,
            'location' => $job->location,
            'description' => $job->description,
            'experience' => $job->experience,
            'salary' => $job->salary,
            'extra_info' => explode(',', $job->extra_info),
            'skills' => $job->skills->map(fn($skill) => [
                'id' => $skill->id,
                'name' => $skill->name,
            ]),
            'created_at' => $job->created_at->diffForHumans(),
        ]);

        return Inertia::render('Dashboard', [
            'jobs' => $jobs,
            'filters' => $request->only(['search', 'location']),
        ]);
    }
}
