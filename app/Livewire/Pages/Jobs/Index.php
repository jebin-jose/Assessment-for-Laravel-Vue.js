<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobPosting;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.pages.jobs.index', [
            'jobs' => JobPosting::with('skills')
                ->latest()
                ->paginate()
        ]);
    }
}
