<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'email', 'resume', 'status'];

    // Relationship with Job model
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
     // Relationship with Applicant model
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
