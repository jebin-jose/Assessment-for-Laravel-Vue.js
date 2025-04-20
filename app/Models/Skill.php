<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];
    
    public function jobPostings()
    {
        return $this->belongsToMany(JobPosting::class, 'job_posting_skill');
    }
}
