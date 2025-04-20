<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobPosting;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithFileUploads;
use Log;

class Create extends Component
{
    use WithFileUploads;
    public $skills;
    public $title, $description, $experience, $salary, $location, $extra_info, $company_name, $logo, $selectedSkills = [];

    /**
     * Initialize the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->skills = Skill::all();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pages.jobs.create');
    }
    /**
     * The properties that should be validated.
     *
     * @var array
     */
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'experience' => 'required|string',
        'salary' => 'required|string',
        'location' => 'required|string',
        'extra_info' => 'nullable|string',
        'company_name' => 'required|string|max:255',
        'logo' => 'required|image|max:2048',
        'selectedSkills' => 'array',
        'selectedSkills.*' => 'exists:skills,id',
    ];

    /**
     * Store a new job posting.
     *
     * @return void
     */
    public function storeJob()
    {
        $this->validate();
        try {

            $logoPath = $this->logo
                ? $this->logo->store('logos', 'public')
                : null;
            $job = JobPosting::create([
                'title' => $this->title,
                'description' => $this->description,
                'experience' => $this->experience,
                'salary' => $this->salary,
                'location' => $this->location,
                'extra_info' => $this->extra_info,
                'company_name' => $this->company_name,
                'logo' => $logoPath,
            ]);
            $job->skills()->sync($this->selectedSkills);

            session()->flash('message', 'Job successfully created.');

            return redirect()->route('admin.jobs.index');
        } catch (\Exception $e) {
            Log::error('Error creating job: ' . $e->getMessage());
            // Handle any error
            session()->flash('error', 'Something went wrong while creating the job: ' . $e->getMessage());
        }
    }
}
