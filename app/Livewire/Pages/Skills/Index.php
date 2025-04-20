<?php

namespace App\Livewire\Pages\Skills;

use App\Models\Skill;
use Livewire\Component;

class Index extends Component
{
    public $skillIdBeingUpdated = null;
    public $name;

    /**
     * list of skills
     */
    public function render()
    {
        return view('livewire.pages.skills.index', [
            'skills' => Skill::latest()->paginate(),
        ]);
    }

    protected $rules = [
        'name' => 'required|string|max:255|unique:skills,name'
    ];

    /**
     * Store a new skill.
     */
    public function storeSkill()
    {
        $this->validate();

        Skill::create([
            'name' => $this->name
        ]);

        $this->reset('name');
        
        session()->flash('message', 'Skill successfully created.');
    }

}
